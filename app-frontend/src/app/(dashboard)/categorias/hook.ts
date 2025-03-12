import { useEffect, useState } from 'react'

import type { Category } from '@/domain/interfaces/produto.interface'

const API_URL = `${process.env.NEXT_PUBLIC_API_URL}/categorias`

interface ApiResponse {
  data: Category[]
}

export const useCategorias = () => {
  const [isModalOpen, setIsModalOpen] = useState(false)
  const [categories, setCategories] = useState<Category[]>([])
  const [editingCategory, setEditingCategory] = useState<Category | undefined>()
  const [isLoading, setIsLoading] = useState(true)
  const [error, setError] = useState('')

  const fetchCategories = async () => {
    try {
      setIsLoading(true)
      setError('')
      const response = await fetch(API_URL)

      if (!response.ok) {
        throw new Error('Falha ao carregar categorias')
      }

      const { data }: ApiResponse = await response.json()

      setCategories(data)
    } catch (err) {
      setError('Erro ao carregar categorias')
      console.error('Error fetching categories:', err)
    } finally {
      setIsLoading(false)
    }
  }

  useEffect(() => {
    fetchCategories()
  }, [])

  const handleAdd = () => {
    setEditingCategory(undefined)
    setIsModalOpen(true)
  }

  const handleEdit = (row: Record<string, any>) => {
    setEditingCategory(row as Category)
    setIsModalOpen(true)
  }

  const handleDelete = async (row: Record<string, any>) => {
    const category = row as Category

    try {
      const response = await fetch(`${API_URL}/${category.id_categoria_planejamento}`, {
        method: 'DELETE'
      })

      if (!response.ok) {
        throw new Error('Falha ao deletar categoria')
      }

      setCategories(prev => prev.filter(c => c.id_categoria_planejamento !== category.id_categoria_planejamento))
    } catch (err) {
      console.error('Error deleting category:', err)
      alert('Erro ao deletar categoria')
    }
  }

  const handleSubmit = async (data: Category) => {
    try {
      const method = editingCategory ? 'PUT' : 'POST'
      const url = editingCategory ? `${API_URL}/${editingCategory.id_categoria_planejamento}` : API_URL

      const response = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })

      if (!response.ok) {
        throw new Error(`Falha ao ${editingCategory ? 'atualizar' : 'criar'} categoria`)
      }

      let updatedCategories

      if (editingCategory) {
        updatedCategories = categories.map(category =>
          category.id_categoria_planejamento === editingCategory.id_categoria_planejamento ? data : category
        )
      } else {
        const { data: newCategory } = await response.json()

        updatedCategories = [...categories, newCategory]
      }

      setCategories(updatedCategories)
      setIsModalOpen(false)
    } catch (err) {
      console.error('Error submitting category:', err)
      alert(`Erro ao ${editingCategory ? 'atualizar' : 'criar'} categoria`)
    }
  }

  return {
    isModalOpen,
    categories,
    editingCategory,
    isLoading,
    error,
    handleAdd,
    handleEdit,
    handleDelete,
    handleSubmit,
    setIsModalOpen
  }
}
