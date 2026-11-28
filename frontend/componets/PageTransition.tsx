'use client'

import { ViewTransition } from 'react'

export default function PageTransition({ children }: { children: React.ReactNode }) {
  return (
      <ViewTransition>{children}</ViewTransition>
  )
}
