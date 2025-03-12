'use client'

import type { FormEvent } from 'react'
import { useState, useEffect } from 'react'

import { Box, Typography } from '@mui/material'

import { BaseModal } from './BaseModal'

interface ProdutoFormData {
  id_produto?: number
  nome_produto: string
  valor_produto: number
  data_cadastro?: string | null
  id_categoria_produto: number
  categoria_produto?: { id_categoria_planejamento: number; nome_categoria: string }
}

interface ProdutoModalProps {
  open: boolean
  onClose: () => void
  onSubmit: (data: ProdutoFormData) => void
  initialData?: ProdutoFormData
  categorias: Array<{ id_categoria_planejamento: number; nome_categoria: string }>
}

export function ProdutoModal({ open, onClose, onSubmit, initialData, categorias }: ProdutoModalProps) {
  const [formData, setFormData] = useState<ProdutoFormData>({
    nome_produto: '',
    valor_produto: 0,
    data_cadastro: null,
    id_categoria_produto: categorias[0]?.id_categoria_planejamento || 0,
    categoria_produto: categorias[0]
  })

  const [error, setError] = useState('')

  useEffect(() => {
    if (initialData) {
      setFormData(initialData)
    } else {
      setFormData({
        nome_produto: '',
        valor_produto: 0,
        data_cadastro: null,
        id_categoria_produto: categorias[0]?.id_categoria_planejamento || 0,
        categoria_produto: categorias[0]
      })
    }
  }, [initialData, categorias])

  const handleSubmit = (e: FormEvent) => {
    e.preventDefault()

    if (formData.nome_produto.trim() === '') {
      setError('Nome do produto é obrigatório')

      return
    }

    if (formData.valor_produto <= 0) {
      setError('Valor deve ser maior que zero')

      return
    }

    if (formData.id_categoria_produto === 0) {
      setError('Categoria é obrigatória')

      return
    }

    onSubmit(formData)
    onClose()
    setFormData({
      nome_produto: '',
      valor_produto: 0,
      data_cadastro: null,
      id_categoria_produto: categorias[0]?.id_categoria_planejamento || 0,
      categoria_produto: categorias[0]
    })
  }

  return (
    <BaseModal open={open} onClose={onClose}>
      <Box sx={{ pt: 2 }}>
        <Typography variant='h6' component='h2' gutterBottom>
          {initialData ? 'Editar Produto' : 'Nova Produto'}
        </Typography>
        <form onSubmit={handleSubmit} className='space-y-4'>
          <div>
            <label htmlFor='nome_produto' className='block text-sm font-medium text-gray-700'>
              Nome do Produto
            </label>
            <input
              type='text'
              id='nome_produto'
              value={formData.nome_produto}
              onChange={e => setFormData({ ...formData, nome_produto: e.target.value })}
              className='mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm'
            />
          </div>

          <div>
            <label htmlFor='valor_produto' className='block text-sm font-medium text-gray-700'>
              Valor
            </label>
            <input
              type='number'
              id='valor_produto'
              min='0'
              step='1'
              value={formData.valor_produto}
              onChange={e => setFormData({ ...formData, valor_produto: Number(e.target.value) })}
              className='mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm'
            />
          </div>

          <div>
            <label htmlFor='categoria' className='block text-sm font-medium text-gray-700'>
              Categoria
            </label>
            <select
              id='categoria'
              value={formData.id_categoria_produto}
              onChange={e =>
                setFormData({
                  ...formData,
                  id_categoria_produto: Number(e.target.value),
                  categoria_produto: categorias.find(
                    categoria => categoria.id_categoria_planejamento === Number(e.target.value)
                  )
                })
              }
              className='mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm'
            >
              <option value='0'>Selecione uma categoria</option>
              {categorias.map(categoria => (
                <option key={categoria.id_categoria_planejamento} value={categoria.id_categoria_planejamento}>
                  {categoria.nome_categoria}
                </option>
              ))}
            </select>
          </div>

          {error && <p className='text-sm text-red-600'>{error}</p>}

          <div className='mt-4 flex justify-end space-x-2'>
            <button
              type='button'
              onClick={onClose}
              className='inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
            >
              Cancelar
            </button>
            <button
              type='submit'
              className='inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2'
            >
              {initialData ? 'Atualizar' : 'Criar'}
            </button>
          </div>
        </form>
      </Box>
    </BaseModal>
  )
}
