'use client'

import { useState, useEffect } from 'react'

import { SimpleTable } from '@/components/tables/SimpleTable'
import { ProdutoModal } from '@/components/modals/ProdutoModal'

const API_URL = `${process.env.NEXT_PUBLIC_API_URL}/produtos`
const API_CATEGORIAS_URL = `${process.env.NEXT_PUBLIC_API_URL}/categorias`

interface Produto {
  id_produto: number
  id_categoria_produto: number
  nome_produto: string
  valor_produto: number
  data_cadastro: string | null
  categoria_produto?: {
    id_categoria_planejamento: number
    nome_categoria: string
  }
}

interface Categoria {
  id_categoria_planejamento: number
  nome_categoria: string
}

interface ApiResponse {
  data: Produto[]
}

interface ApiCategoriaResponse {
  data: Categoria[]
}

const columns = [
  { id: 'id_produto', label: 'ID' },
  { id: 'nome_produto', label: 'Nome' },
  { id: 'valor_produto', label: 'Valor' },
  { id: 'categoria', label: 'Categoria', render: (row: Record<string, any>) => (row as Produto).categoria_produto?.nome_categoria || '-' }
]

export default function ProdutosPage() {
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

  if (isLoading) {
    return <div className='p-6'>Carregando...</div>
  }

  if (error) {
    return <div className='p-6 text-red-600'>{error}</div>
  }

  return (
    <div className='p-6'>
      <h1 className='mb-4 text-xl font-bold'>Produtos</h1>

      <SimpleTable
        columns={columns}
        rows={produtos}
        onAdd={() => {
          setEditingProduto(undefined)
          setIsModalOpen(true)
        }}
        onEdit={(row: Record<string, any>) => handleEdit(row as Produto)}
        onDelete={(row: Record<string, any>) => handleDelete(row as Produto)}
      />

      <ProdutoModal
        open={isModalOpen}
        onClose={() => {
          setIsModalOpen(false)
          setEditingProduto(undefined)
        }}
        onSubmit={async formData => {
          // Ensure id_produto is present for existing products
          const data = editingProduto ? { ...formData, id_produto: editingProduto.id_produto } : formData

          await handleSubmit(data as Produto)
        }}
        initialData={editingProduto}
        categorias={categorias}
      />
    </div>
  )
}
