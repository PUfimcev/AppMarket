import Link from 'next/link'
import Image from 'next/image'
import { Suspense } from 'react'
import Navigation from '@/componets/Navigation'
import NavigationSkeleton from '@/componets/ui/NavigationSkeleton'

export default function Header() {
  return (
    <header className="site-header" style={{ viewTransitionName: 'site-header' }}>
      <Link
        href="/"
        className="group inline-flex rounded-md transition-opacity hover:opacity-80"
      >
        <Image
          className="h-5 w-5 dark:invert transition-transform duration-200 ease-out group-hover:scale-110"
          src="/images/icons/apple.svg"
          alt="App logo"
          width={50}
          height={50}
          priority
        />
      </Link>
      <Suspense fallback={<NavigationSkeleton />}>
        <Navigation />
      </Suspense>
    </header>
  )
}
