export interface Categoria {
  id_categoria_planejamento: number
  nome_categoria: string
}

export interface Produto {
  id_produto: number
  id_categoria_produto: number
  nome_produto: string
  valor_produto: number
  data_cadastro: string | null
  categoria_produto?: Categoria
}
