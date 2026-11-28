import Link from 'next/link'

export default function NotFound() {
  return (
    <div className="flex min-h-[calc(100dvh-5rem)] flex-col items-center justify-center bg-[#fbfbfd] px-6 dark:bg-black">
      <main className="mx-auto w-full max-w-[32rem] text-center">
        <h1 className="text-[1.5rem] font-semibold leading-[1.1] tracking-tight text-zinc-900 dark:text-zinc-100 sm:text-3xl">
          The page you&apos;re looking for can&apos;t be found.
        </h1>
        <p className="mt-5 text-xl leading-normal text-zinc-500 dark:text-zinc-400">
          The link may be broken, or the page may have been removed.
        </p>
        <Link
          href="/"
          className="mt-10 inline-flex min-w-[11rem] items-center justify-center rounded-full bg-[#0071e3] px-7 py-3 text-base font-medium text-white transition-colors hover:bg-[#0077ed] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0071e3]"
          transitionTypes={['nav-forward']}
        >
          Go to homepage
        </Link>
      </main>
    </div>
  )
}