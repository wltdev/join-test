import {
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  IconButton,
  Button,
  Box
} from '@mui/material'
import DeleteIcon from '@mui/icons-material/Delete'
import EditIcon from '@mui/icons-material/Edit'
import AddIcon from '@mui/icons-material/Add'

interface Column {
  id: string
  label: string
  render?: (row: Record<string, any>) => React.ReactNode
}

interface SimpleTableProps {
  columns: Column[]
  rows: Record<string, any>[]
  onEdit?: (row: Record<string, any>) => void
  onDelete?: (row: Record<string, any>) => void
  onAdd?: () => void
}

export const SimpleTable = ({ columns, rows, onEdit, onDelete, onAdd }: SimpleTableProps) => {
  return (
    <TableContainer component={Paper} style={{ padding: 16 }}>
      <Box sx={{ display: 'flex', justifyContent: 'flex-end', p: 2 }}>
        {onAdd && (
          <Button variant='contained' color='primary' startIcon={<AddIcon />} onClick={onAdd}>
            Adicionar Registro
          </Button>
        )}
      </Box>
      <Table sx={{ minWidth: 650 }} aria-label='simple table'>
        <TableHead>
          <TableRow>
            {columns.map(column => (
              <TableCell key={column.id}>{column.label}</TableCell>
            ))}
            <TableCell align='right'>Actions</TableCell>
          </TableRow>
        </TableHead>
        <TableBody>
          {rows.map((row, index) => (
            <TableRow key={index} sx={{ '&:last-child td, &:last-child th': { border: 0 } }}>
              {columns.map(column => (
                <TableCell key={column.id}>
                  {column.render ? column.render(row) : row[column.id]}
                </TableCell>
              ))}
              <TableCell align='right'>
                {onEdit && (
                  <IconButton onClick={() => onEdit(row)} color='primary' size='small'>
                    <EditIcon />
                  </IconButton>
                )}
                {onDelete && (
                  <IconButton onClick={() => onDelete(row)} color='error' size='small'>
                    <DeleteIcon />
                  </IconButton>
                )}
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </TableContainer>
  )
}
