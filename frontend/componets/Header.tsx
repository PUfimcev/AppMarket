import Link from 'next/link'
import Image from 'next/image'
import { Suspense } from 'react'
import Navigation from '@/componets/Navigation'
import NavigationSkeleton from '@/componets/ui/NavigationSkeleton'

export default function Header() {
  return (
    <header
      className={`site-header sticky top-0 z-50 w-full overflow-visible select-none text-[17px] h-[var(--r-globalnav-height)] max-h-[var(--r-globalnav-height)] bg-[var(--globalnav-scrim-bg)] [backdrop-filter:var(--globalnav-backdrop-filter)] [-webkit-backdrop-filter:var(--globalnav-backdrop-filter)]`}
      style={{ viewTransitionName: 'site-header' }}
    >
      <div className="globalnav-content flex h-[var(--r-globalnav-height)] flex-nowrap items-center overflow-visible">
        <Link
          href="/"
          className="inline-flex h-[var(--r-globalnav-height)] shrink-0 items-center px-2"
          aria-label="Home"
        >
          <Image
            className="h-[15px] w-[15px] dark:invert"
            src="/images/icons/apple.svg"
            alt=""
            width={50}
            height={50}
            priority
          />
        </Link>
        <Suspense fallback={<NavigationSkeleton />}>
          <Navigation />
        </Suspense>
      </div>
      <div
        className="globalnav-curtain pointer-events-none fixed inset-0 z-40 size-full invisible opacity-0 bg-[var(--globalnav-curtain)] backdrop-blur-[20px] transition-[opacity,visibility] duration-300 ease-[cubic-bezier(0.4,0,0.6,1)] delay-80"
        aria-hidden
      />
    </header>
  )
}