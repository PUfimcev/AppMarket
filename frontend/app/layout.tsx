import type { Metadata } from 'next'
import { Inter } from 'next/font/google'
import './globals.css'
import Header from '@/componets/Header'
import PageTransition from "@/componets/PageTransition";

const inter = Inter({
  subsets: ['latin', 'cyrillic'],
  variable: '--font-inter',
})

export const metadata: Metadata = {
  title: 'Home | AppMarket',
  description: 'AppMarket is the main page Home',
}

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en" className={inter.variable}>
      <body className="flex min-h-dvh flex-col bg-background font-sans text-foreground antialiased">
        <Header/>
        <PageTransition>
            {children}
        </PageTransition>
      </body>
    </html>
  )
}
