import { cacheLife } from 'next/cache'

export type CategoryChild = {
  slug: string
  name: string
  description: string
  new_text: string
  icon_url: string
  parent_slug: string
  parent_name: string
}

export type Category = {
  slug: string
  name: string
  description: string
  new_text: string
  icon_url: string
  children: CategoryChild[]
}

type CategoriesApiResponse = {
  success: boolean
  message: string
  data: Category[]
}
export async function getCategories(): Promise<Category[]> {
  'use cache'

  cacheLife({ revalidate: 10, stale: 10, expire: 300 })

  const response = await fetch(`${process.env.API_URL}/categories`, {
    next: { revalidate: 10 },
  })

  if (!response.ok) {
    return []
  }

  const body = (await response.json()) as CategoriesApiResponse

  if (!body.success || !Array.isArray(body.data)) {
    return []
  }

  return body.data
}
