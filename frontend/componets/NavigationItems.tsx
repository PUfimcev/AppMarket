'use client'

import Link from 'next/link'
import type { Category, CategoryChild } from '@/services/api/category.service'
import { useMemo, useState } from 'react'

const navLink =
  'globalnav-link flex h-[var(--r-globalnav-height)] items-center whitespace-nowrap px-2 text-xs leading-none font-normal tracking-tight text-[color:var(--r-globalnav-color)] no-underline transition-[color,opacity,visibility] duration-200 ease-[cubic-bezier(0.4,0,0.6,1)] delay-80 hover:text-[color:var(--r-globalnav-color-hover)]'

const submenuLink =
  'block py-0.5 text-[17px] font-semibold leading-[1.4705882353] tracking-[-0.022em] text-[color:var(--r-globalnav-color-secondary)] no-underline transition-colors duration-200 hover:text-[color:var(--r-globalnav-color-hover)]'

type CategoriesProps = {
  categories: Category[]
}

type CategoryProps = {
  category: Category
}

export default function NavItems({ categories }: CategoriesProps) {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null)

  const hoveredCategory = useMemo((): Category | null => {
    if (hoveredIndex === null) return null
    return categories[hoveredIndex] ?? null
  }, [hoveredIndex])

  return (
    <div className="relative flex min-w-0 flex-1" onMouseLeave={() => setHoveredIndex(null)}>
      <ul className="globalnav-list animate-nav-drop-in -mx-2 flex h-[var(--r-globalnav-height)] flex-1 list-none flex-wrap items-center justify-between gap-y-0 overflow-visible p-0 cursor-default">
        {categories.map((category, index) => (
          <li
            key={category.slug}
            className="globalnav-item group/item relative flex h-full items-center"
            style={{ animationDelay: `${index * 45}ms` }}
            onMouseEnter={() =>
              category.children.length > 0 ? setHoveredIndex(index) : setHoveredIndex(null)
            }
          >
            <Link
              href={`/${category.slug}`}
              className={navLink}
              transitionTypes={['nav-forward']}
              {...(category.children.length > 0 ? { 'aria-haspopup': true as const } : {})}
            >
              {category.name}
            </Link>
          </li>
        ))}
      </ul>
      {hoveredCategory?.children.length ? <NavSubItems category={hoveredCategory} /> : null}
    </div>
  )
}

function NavSubItems({ category }: CategoryProps) {
  return (
    <div
      className="globalnav-submenu pointer-events-auto fixed start-0 top-[var(--r-globalnav-height)] z-[45] m-0 w-full max-h-[min(70vh,520px)] overflow-hidden bg-[var(--globalnav-flyout-bg)] opacity-100 py-10 px-6"
      role="region"
      aria-label={`${category.name} submenu`}
    >
      <div className="globalnav-content w-full py-[var(--r-globalnav-flyout-spacing)]">
        <ul className="m-0 flex list-none flex-col gap-1.5 p-0 min-[834px]:flex-col min-[834px]:flex-wrap min-[834px]:gap-x-11 min-[834px]:gap-y-2">
          {category.children.map((child, index) => (
            <SubmenuItem key={child.slug} child={child} index={index} />
          ))}
        </ul>
      </div>
    </div>
  )
}

function SubmenuItem({ child, index }: { child: CategoryChild; index: number }) {
  const delayMs = index * 70

  return (
    <li>
      <Link
        href={`/${child.slug}`}
        className={submenuLink}
        transitionTypes={['nav-forward']}
        style={{
          animation: `globalnav-flyout-link-in 0.5s ease ${delayMs}ms both`,
        }}
      >
        {child.name}
      </Link>
    </li>
  )
}