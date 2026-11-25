import { cacheLife } from 'next/cache'

export type TopCategory = {
  slug: string
  name: string
}

type TopCategoriesApiResponse = {
  success: boolean
  message: string
  data: TopCategory[]
}
export async function getTopCategories(): Promise<TopCategory[]> {
  'use cache'

  cacheLife({ revalidate: 10, stale: 10, expire: 300 })

  const response = await fetch(`${process.env.API_URL}/top-categories`, {
    next: { revalidate: 10 },
  })

  if (!response.ok) {
    throw new Error(`Failed: HTTP ${response.status}`)
  }

  const body = (await response.json()) as TopCategoriesApiResponse

  if (!body.success || !Array.isArray(body.data)) {
    return []
  }

  return body.data
}