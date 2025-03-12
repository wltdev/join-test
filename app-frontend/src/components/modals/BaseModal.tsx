import type { ReactNode } from 'react'

import { Modal, Box, IconButton } from '@mui/material'
import CloseIcon from '@mui/icons-material/Close'

interface BaseModalProps {
  open: boolean
  onClose: () => void
  children: ReactNode
}

const modalStyle = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 400,
  bgcolor: 'background.paper',
  borderRadius: 1,
  boxShadow: 24,
  p: 4
}

export const BaseModal = ({ open, onClose, children }: BaseModalProps) => {
  return (
    <Modal open={open} onClose={onClose} aria-labelledby='modal-title' aria-describedby='modal-description'>
      <Box sx={modalStyle}>
        <IconButton
          aria-label='close'
          onClick={onClose}
          sx={{
            position: 'absolute',
            right: 8,
            top: 8,
            color: 'grey.500'
          }}
        >
          <CloseIcon />
        </IconButton>
        {children}
      </Box>
    </Modal>
  )
}
