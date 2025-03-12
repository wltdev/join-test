'use client'

import { SimpleTable } from '@/components/tables/SimpleTable'
import { CategoryModal } from '@/components/modals/CategoryModal'
import { useCategorias } from './hook'
import type { Category } from '@/domain/interfaces/produto.interface'

const columns = [
  { id: 'id_categoria_planejamento', label: 'ID' },
  { id: 'nome_categoria', label: 'Nome' }
]

export default function CategoriesPage() {
  const {
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
  } = useCategorias()

  if (isLoading) {
    return <div style={{ padding: '24px' }}>Carregando...</div>
  }

  if (error) {
    return <div style={{ padding: '24px', color: 'red' }}>{error}</div>
  }

  return (
    <div style={{ padding: '24px' }}>
      <h1 style={{ marginBottom: '24px', fontSize: '24px', fontWeight: 500 }}>Categorias</h1>
      <SimpleTable columns={columns} rows={categories} onAdd={handleAdd} onEdit={handleEdit} onDelete={handleDelete} />

      <CategoryModal
        open={isModalOpen}
        onClose={() => setIsModalOpen(false)}
        onSubmit={data => handleSubmit(data as Category)}
        initialData={
          editingCategory
            ? {
                ...editingCategory
              }
            : undefined
        }
      />
    </div>
  )
}
