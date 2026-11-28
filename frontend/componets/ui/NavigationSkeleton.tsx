import Skeleton from '@/componets/ui/Skeleton'

const PLACEHOLDER_WIDTHS = ['w-9', 'w-14', 'w-10', 'w-24', 'w-16', 'w-20'] as const

export default function NavigationSkeleton() {
  return (
    <nav
      className="ms-4 flex min-w-0 flex-1 overflow-visible"
      aria-busy="true"
      aria-label="Loading navigation"
    >
      <ul className="-mx-2 flex h-[var(--r-globalnav-height)] flex-1 list-none items-center gap-x-2 overflow-visible p-0">
        {PLACEHOLDER_WIDTHS.map((widthClass, index) => (
          <li key={index} className="relative flex h-full items-center" aria-hidden>
            <Skeleton className={`h-3 ${widthClass}`} />
          </li>
        ))}
      </ul>
    </nav>
  )
}