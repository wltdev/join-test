import type { FormEvent, ChangeEvent } from 'react'
import { useState, useEffect } from 'react'

import { TextField, Button, Box, Typography } from '@mui/material'

import { BaseModal } from './BaseModal'

interface CategoryModalProps {
  open: boolean
  onClose: () => void
  onSubmit: (data: CategoryFormData) => void
  initialData?: CategoryFormData
}

interface CategoryFormData {
  nome_categoria: string
}

export const CategoryModal = ({ open, onClose, onSubmit, initialData }: CategoryModalProps) => {
  const [formData, setFormData] = useState<CategoryFormData>({
    nome_categoria: ''
  })

  const [error, setError] = useState('')

  useEffect(() => {
    if (initialData) {
      setFormData(initialData)
    } else {
      setFormData({
        nome_categoria: ''
      })
    }
  }, [initialData])

  const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target

    setFormData(prev => ({
      ...prev,
      [name]: value
    }))

    if (name === 'nome_categoria' && value.trim() !== '') {
      setError('')
    }
  }

  const handleSubmit = (e: FormEvent) => {
    e.preventDefault()

    if (formData.nome_categoria.trim() === '') {
      setError('Nome da categoria é obrigatório')

      return
    }

    const submissionData = {
      ...formData
    }

    onSubmit(submissionData)
    onClose()
    setFormData({
      nome_categoria: ''
    })
  }

  return (
    <BaseModal open={open} onClose={onClose}>
      <Box sx={{ pt: 2 }}>
        <Typography variant='h6' component='h2' gutterBottom>
          {initialData ? 'Editar Categoria' : 'Nova Categoria'}
        </Typography>
        <form onSubmit={handleSubmit}>
          <TextField
            name='nome_categoria'
            value={formData.nome_categoria}
            onChange={handleChange}
            fullWidth
            label='Nome da Categoria'
            margin='normal'
            error={!!error}
            helperText={error}
            required
          />
          <Box sx={{ mt: 4, display: 'flex', justifyContent: 'flex-end', gap: 2 }}>
            <Button onClick={onClose} variant='outlined'>
              Cancelar
            </Button>
            <Button type='submit' variant='contained' color='primary'>
              {initialData ? 'Atualizar' : 'Salvar'}
            </Button>
          </Box>
        </form>
      </Box>
    </BaseModal>
  )
}
