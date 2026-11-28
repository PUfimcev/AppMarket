'use client'

import Link from 'next/link'

type ErrorProps = {
  error: Error
  reset: () => void
}

export default function Error({ error, reset }: ErrorProps) {

  return (
    <div className="flex min-h-[calc(100dvh-5rem)] flex-col items-center justify-center bg-[#fbfbfd] px-6 dark:bg-black">
      <main className="mx-auto w-full max-w-[32rem] text-center">
        <h1 className="text-[1.5rem] font-semibold leading-[1.1] tracking-tight text-zinc-900 dark:text-zinc-100 sm:text-3xl">
          Something went wrong
        </h1>
        <p className="mt-5 text-xl leading-normal text-zinc-500 dark:text-zinc-400">
          You can try again or return to the homepage.
        </p>
        <div className="mt-10 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
          <button
            type="button"
            onClick={reset}
            className="inline-flex min-w-[11rem] items-center justify-center rounded-full bg-[#0071e3] px-7 py-3 text-base font-medium text-white transition-colors hover:bg-[#0077ed] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0071e3]"
          >
            Try again
          </button>
          <Link
            href="/"
            className="text-lg text-[#0071e3] transition-colors hover:text-[#0077ed] hover:underline dark:text-[#2997ff] dark:hover:text-[#47a1ff]"
            transitionTypes={['nav-forward']}
          >
            Go to homepage
          </Link>
        </div>
      </main>
    </div>
  )
}
