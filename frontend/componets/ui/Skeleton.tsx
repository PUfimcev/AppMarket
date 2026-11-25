import React from 'react'

export default function Skeleton({
  className,
  ...props
}: React.ComponentProps<'div'>): React.ReactElement {
  return (
    <div
      aria-hidden
      className={`relative overflow-hidden rounded-md bg-zinc-200 dark:bg-zinc-700 before:absolute before:inset-0 before:-translate-x-full before:animate-shimmer before:bg-gradient-to-r before:from-transparent before:via-white/60 before:to-transparent dark:before:via-white/10 ${className ?? ''}`}
      {...props}
    />
  )
}
