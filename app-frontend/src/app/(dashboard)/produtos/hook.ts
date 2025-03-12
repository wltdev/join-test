import { useState, useEffect } from 'react'

import type { Produto, Categoria } from '@/domain/interfaces/produto.interface'

const API_URL = `${process.env.NEXT_PUBLIC_API_URL}/produtos`
const API_CATEGORIAS_URL = `${process.env.NEXT_PUBLIC_API_URL}/categorias`

interface ApiResponse {
  data: Produto[]
}

interface ApiCategoriaResponse {
  data: Categoria[]
}

export const useProdutos = () => {
  const [isModalOpen, setIsModalOpen] = useState(false)
  const [produtos, setProdutos] = useState<Produto[]>([])
  const [categorias, setCategorias] = useState<Categoria[]>([])
  const [editingProduto, setEditingProduto] = useState<Produto | undefined>()
  const [isLoading, setIsLoading] = useState(true)
  const [error, setError] = useState('')

  const fetchProdutos = async () => {
    try {
      setIsLoading(true)
      setError('')
      const response = await fetch(API_URL)

      if (!response.ok) {
        throw new Error('Falha ao carregar produtos')
      }

      const { data }: ApiResponse = await response.json()

      setProdutos(data)
    } catch (err) {
      setError('Erro ao carregar produtos')
      console.error('Error fetching produtos:', err)
    } finally {
      setIsLoading(false)
    }
  }

  const fetchCategorias = async () => {
    try {
      const response = await fetch(API_CATEGORIAS_URL)

      if (!response.ok) {
        throw new Error('Falha ao carregar categorias')
      }

      const { data }: ApiCategoriaResponse = await response.json()

      setCategorias(data)
    } catch (err) {
      console.error('Error fetching categorias:', err)
    }
  }

  useEffect(() => {
    fetchProdutos()
    fetchCategorias()
  }, [])

  const handleEdit = (produto: Produto) => {
    setEditingProduto(produto)
    setIsModalOpen(true)
  }

  const handleDelete = async (produto: Produto) => {
    if (!confirm('Tem certeza que deseja excluir este produto?')) {
      return
    }

    try {
      const response = await fetch(`${API_URL}/${produto.id_produto}`, {
        method: 'DELETE'
      })

      if (!response.ok) {
        throw new Error('Falha ao excluir produto')
      }

      setProdutos(prev => prev.filter(p => p.id_produto !== produto.id_produto))
    } catch (err) {
      console.error('Error deleting produto:', err)
      alert('Erro ao excluir produto')
    }
  }

  const handleSubmit = async (formData: Omit<Produto, 'id_produto'> & { id_produto?: number }) => {
    try {
      const method = editingProduto ? 'PUT' : 'POST'
      const url = editingProduto ? `${API_URL}/${editingProduto.id_produto}` : API_URL

      const response = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
      })

      if (!response.ok) {
        throw new Error(`Falha ao ${editingProduto ? 'atualizar' : 'criar'} produto`)
      }

      const { data: responseData } = await response.json()

      if (editingProduto) {
        setProdutos(prev =>
          prev.map(produto => (produto.id_produto === editingProduto.id_produto ? responseData : produto))
        )
      } else {
        setProdutos(prev => [...prev, responseData])
      }

      setIsModalOpen(false)
      setEditingProduto(undefined)
    } catch (err) {
      console.error('Error submitting produto:', err)
      alert(`Erro ao ${editingProduto ? 'atualizar' : 'criar'} produto`)
    }
  }

  return {
    isModalOpen,
    produtos,
    categorias,
    editingProduto,
    isLoading,
    error,
    setEditingProduto,
    handleEdit,
    handleDelete,
    handleSubmit,
    setIsModalOpen
  }
}
