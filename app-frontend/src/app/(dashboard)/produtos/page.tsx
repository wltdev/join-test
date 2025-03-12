'use client'

import { SimpleTable } from '@/components/tables/SimpleTable'
import { ProdutoModal } from '@/components/modals/ProdutoModal'
import type { Produto } from '@/domain/interfaces/produto.interface'
import { useProdutos } from './hook'

const columns = [
  { id: 'id_produto', label: 'ID' },
  { id: 'nome_produto', label: 'Nome' },
  { id: 'valor_produto', label: 'Valor' },
  {
    id: 'categoria',
    label: 'Categoria',
    render: (row: Record<string, any>) => (row as Produto).categoria_produto?.nome_categoria || '-'
  }
]

export default function ProdutosPage() {
  const {
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
  } = useProdutos()

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
