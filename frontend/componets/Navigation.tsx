import { getCategories } from '@/services/api/category.service'
import NavItems from '@/componets/NavigationItems'

export default async function Navigation() {
  const categories = await getCategories()

  return (
    <nav className="ms-4 flex min-w-0 flex-1 overflow-visible" aria-label="Main">
      <NavItems categories={categories}/>
    </nav>
  )
}