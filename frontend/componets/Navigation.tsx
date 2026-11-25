import Link from 'next/link'
import { getTopCategories } from '@/services/api/category.service'

export default async function Navigation() {
  const categories = await getTopCategories()

  return (
    <nav className="w-full">
      <ul className="flex flex-wrap items-center gap-x-6 gap-y-2 px-4 py-2">
        {categories.map((category) => (
          <li key={category.slug}>
            <Link
              href={`/${category.slug}`}
              className="text-sm text-zinc-800 hover:text-zinc-500 dark:text-zinc-200 dark:hover:text-zinc-400"
              transitionTypes={['nav-forward']}
            >
              {category.name}
            </Link>
          </li>
        ))}
      </ul>
    </nav>
  )
}