import Skeleton from '@/componets/ui/Skeleton'

const PLACEHOLDER_WIDTHS = ['w-9', 'w-14', 'w-10', 'w-24', 'w-16', 'w-20'] as const

export default function NavigationSkeleton() {
  return (
    <nav className="w-full" aria-busy="true" aria-label="Loading navigation">
      <ul className="flex flex-wrap items-center gap-x-6 gap-y-2 px-4 py-2">
        {PLACEHOLDER_WIDTHS.map((widthClass, index) => (
          <li key={index} aria-hidden>
            <Skeleton className={`h-3.5 ${widthClass}`} />
          </li>
        ))}
      </ul>
    </nav>
  )
}