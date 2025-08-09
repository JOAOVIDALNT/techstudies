# NEXT APPLICATION DEEP DIVE

## FOLDER STRUCTURE

- `/app`: Contains all the routes, components, and logic for your application, this is where you'll be mostly working from.

- `/app/lib`: Contains functions used in your application, such as reusable utility functions and data fetching functions.

- `/app/ui`: Contains all the UI components for your application, such as cards, tables, and forms. To save time, we've pre-styled these components for you.

- `/public`: Contains all the static assets for your application, such as images.
Config Files: You'll also notice config files such as next.config.ts at the root of your application. Most of these files are created and pre-configured when you start a new project using create-next-app. You will not need to modify them in this course.

## STYLE

### GLOBAL CSS

To add a global css, just navigate to app/layout.tsx and import your global.css file:
```tsx
import '@/app/ui/global.css';
 
export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body>{children}</body>
    </html>
  );
}
```

### TAILWIND
Next always give the option to use Tailwind when creating an app, considering the diferent structure of a React based project that doesn't have `html` files, with this style should be applied right inside tags, just like this (using tailwing):
```jsx
<h1 className="text-blue-500">I'm blue!</h1>
```

### CSS MODULES
You can either use `CSS Modules` to handle your styles
```css
/* /app/ui/home.module.css */
.shape {
  height: 0;
  width: 0;
  border-bottom: 30px solid black;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
}
```

```tsx
import AcmeLogo from '@/app/ui/acme-logo';
import { ArrowRightIcon } from '@heroicons/react/24/outline';
import Link from 'next/link';
import styles from '@/app/ui/home.module.css';
 
export default function Page() {
  return (
    <main className="flex min-h-screen flex-col p-6">
      <div className={styles.shape} />
    // ...
  )
}
```

### CLSX

There may be cases where you may need to conditionally style an element based on state or some other condition.

`clsx` is a library that lets you toggle class names easily. We recommend taking a look at documentation for more details, but here's the basic usage:

Suppose that you want to create an InvoiceStatus component which accepts status. The status can be 'pending' or 'paid'.

If it's 'paid', you want the color to be green. If it's 'pending', you want the color to be gray.
You can use clsx to conditionally apply the classes, like this:

```tsx
import clsx from 'clsx';
 
export default function InvoiceStatus({ status }: { status: string }) {
  return (
    <span
      className={clsx(
        'inline-flex items-center rounded-full px-2 py-1 text-sm',
        {
          'bg-gray-100 text-gray-500': status === 'pending',
          'bg-green-500 text-white': status === 'paid',
        },
      )}
    >
    // ...
)}
```
### FONTS
Next automatically optimize fonts when you use `next/font` module, avoiding layout shift on page load.
By simply downloading font files at build time and hosts them with your other static assets. This means when a user visits your application, there are no additional network requests for fonts which would impact performance.

Import the `Inter` font from the `next/font/google` module - this will be your primary font. Then, specify what subset you'd like to load. In this case, 'latin':

```ts
// /app/ui/fonts.ts -> created manually
import { Inter } from 'next/font/google';
 
export const inter = Inter({ subsets: ['latin'] });
```
Finally, add the font to the `<body>` element in `/app/layout.tsx`:
```tsx
import '@/app/ui/global.css';
import { inter } from '@/app/ui/fonts';
 
export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body className={`${inter.className} antialiased`}>{children}</body>
    </html>
  );
}
```
By adding Inter to the `<body>` element, the font will be applied throughout your application. Here, you're also adding the Tailwind `antialiased` class which smooths out the font. It's not necessary to use this class, but it adds a nice touch.

 ### IMAGE

 Next.js can serve static assets, like images, under the top-level /public folder. Files inside /public can be referenced in your application.

 With regular HTML, you would add an image as follows:
 ```html
<img
  src="/hero.png"
  alt="Screenshots of the dashboard project showing desktop version"
/>
 ```
However, this means you have to manually:

- Ensure your image is responsive on different screen sizes.
- Specify image sizes for different devices.
- Prevent layout shift as the images load.
- Lazy load images that are outside the user's viewport.

Image Optimization is a large topic in web development that could be considered a specialization in itself. Instead of manually implementing these optimizations, you can use the `next/image` component to automatically optimize your images.

#### The `<Image>` component
The `<Image>` Component is an extension of the HTML `<img>` tag, and comes with automatic image optimization, such as:

- Preventing layout shift automatically when images are loading.
- Resizing images to avoid shipping large images to devices with a smaller viewport.
- Lazy loading images by default (images load as they enter the viewport).
- Serving images in modern formats, like WebP and AVIF, when the browser supports it.

```tsx
import AcmeLogo from '@/app/ui/acme-logo';
import { ArrowRightIcon } from '@heroicons/react/24/outline';
import Link from 'next/link';
import { lusitana } from '@/app/ui/fonts';
import Image from 'next/image';
 
export default function Page() {
  return (
    // ...
    <div className="flex items-center justify-center p-6 md:w-3/5 md:px-28 md:py-12">
      {/* Add Hero Images Here */}
      <Image
        src="/hero-desktop.png"
        width={1000}
        height={760}
        className="hidden md:block"
        alt="Screenshots of the dashboard project showing desktop version"
      />
      <Image
        src="/hero-mobile.png"
        width={560}
        height={620}
        className="block md:hidden"
        alt="Screenshot of the dashboard project showing mobile version"
      />
    </div>
    //...
  );
}
```

There's a responsive setup made by `TailwindCSS`:
- `md` indicate the behavior when the screen has 768px or more
- Tailwind uses `mobile first` logic, so the first behavior will be always about 768px or less
example
```tsx
<Image
  src="/hero-desktop.png"
  className="hidden md:block" 
/>
// hidden -> the image is 'display:none' at 768px or less
// md:block -> the image is 'display:block' at 768px or more

<Image
  src="/hero-mobile.png"
  className="block md:hidden"
/>

// block -> the image is 'display:block' at 768px or less
// md:hidden -> the image is 'display:none' at 768px or more
```

## ROUTING
Routing on next.js is pretty simple. Folders inside `app/` who contains a file named `page.tsx` will be a route automatically. Of course you'll need to exporta default function.

### LAYOUT
`layout.tsx` is where we place shared design to be applied accros pages inside the placed root.
For example, for a `layout.tsx` placed inside `/app/dashboard` all the `page` files inside root dashboard/ will be impacted.

layout code example:
```tsx
import SideNav from "../ui/dashboard/sidenav";

export default function Layout({
    children,
}: {
    children: React.ReactNode;
}) {
    return (
        <div className="flex h-screen flex-col md:flex-row md:overflow-hidden">
            <div className="w-full flex-none md:w-64">
                <SideNav />
            </div>
            <div className="flex-grow p-6 md:overflow-y-auto md:p-12">{children}</div>
        </div>
    );
}
```

A layout also complement and previous root layout.
For example: the `app/layout.tsx` still working inside `dashboard` pages that happens because `dashboard/layout.tsx` is also renderend as a children of `app/layout.tsx`
Code example of `app/layout.tsx` that only defines the main font:
```tsx
import '@/app/ui/global.css';
import { inter } from 'app/ui/fonts';

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <body className={`${inter.className} antialiased`}>{children}</body>
    </html>
  );
}
```
remember that a root layout is required in every next.js application. Any UI you add to the root layout will be shared across all pages in your application. You can use the root layout to modify your `<html>` and `<body>` tags, and add metadata

One benefit of using layouts in Next.js is that on navigation, only the page components update while the layout won't re-render. This is called partial rendering which preserves client-side React state in the layout when transitioning between pages.

### NAVIGATING

#### LINK COMPONENT
`next/link` component made an eficient navigation between components. When you use `<a>` to navigate, the page refresh on each page navigation, `<Link>` allows you to do client-side navigation with javascript.

Next.js automatically code splits your application by routesegments. This is different from a traditional React SPA, where the browser loads all your application code on the initial page load.

Splitting code by routes means that pages become isolated. If a certain page throws an error, the rest of the application will still work. This is also less code for the browser to parse, which makes your application faster.

Furthermore, in production, whenever <Link> components appear in the browser's viewport, Next.js automatically prefetches the code for the linked route in the background. By the time the user clicks the link, the code for the destination page will already be loaded in the background, and this is what makes the page transition near-instant!

#### SHOWING ACTIVE LINKS
A common UI pattern is to show an active link to indicate to the user what page they are currently on. To do this, you need to get the user's current path from the URL. Next.js provides a hook called usePathname() that you can use to check the path and implement this pattern.

Since `usePathname()` is a React hook, you'll need to turn `nav-links.tsx` into a `Client Component`. Add React's "use client" directive to the top of the file, then import `usePathname()` from `next/navigation`:

### RESULT
That's how a class seems when using `<Link>` and `usePathname`:

```tsx
'use client';
 
import {
  UserGroupIcon,
  HomeIcon,
  DocumentDuplicateIcon,
} from '@heroicons/react/24/outline';
import Link from 'next/link';
import { usePathname } from 'next/navigation';
import clsx from 'clsx';
 
// ... -> Array with links
 
export default function NavLinks() {
  const pathname = usePathname();
 
  return (
    <>
      {links.map((link) => {
        const LinkIcon = link.icon;
        return (
          <Link
            key={link.name}
            href={link.href}
            className={clsx(
              'flex h-[48px] grow items-center justify-center gap-2 rounded-md bg-gray-50 p-3 text-sm font-medium hover:bg-sky-100 hover:text-blue-600 md:flex-none md:justify-start md:p-2 md:px-3',
              {
                'bg-sky-100 text-blue-600': pathname === link.href, // conditional
              },
            )}
          >
            <LinkIcon className="w-6" />
            <p className="hidden md:block">{link.name}</p>
          </Link>
        );
      })}
    </>
  );
}
```

## DEPLOY
We use vercel to deploy, it's easy to do by just associating a root folder on our repository and deployng, after that we also deployed a database by accessing `storage` at our vercel app dashboard and creating a database, we also copy .env on vercel and paste on our local .env in order to use dinamically locally.

Our database will be seeded for our seed process, wich create and insert custom data.

## FETCHING DATA

Using Server Components to fetch data
By default, Next.js applications use React Server Components. Fetching data with Server Components is a relatively new approach and there are a few benefits of using them:

- Server Components support JavaScript Promises, providing a solution for asynchronous tasks like data fetching natively. You can use async/await syntax without needing useEffect, useState or other data fetching libraries.
- Server Components run on the server, so you can keep expensive data fetches and logic on the server, only sending the result to the client.
- Since Server Components run on the server, you can query the database directly without an additional API layer. This saves you from writing and maintaining additional code.

### REQUEST WATTERFALL'S
A "waterfall" refers to a sequence of network requests that depend on the completion of previous requests. In the case of data fetching, each request can only begin once the previous request has returned data.

For example, we need to wait for fetchRevenue() to execute before fetchLatestInvoices() can start running, and so on.

```tsx
const revenue = await fetchRevenue();
const latestInvoices = await fetchLatestInvoices(); // wait for fetchRevenue() to finish
const {
  numberOfInvoices,
  numberOfCustomers,
  totalPaidInvoices,
  totalPendingInvoices,
} = await fetchCardData(); // wait for fetchLatestInvoices() to finish
```

This pattern is not necessarily bad. There may be cases where you want waterfalls because you want a condition to be satisfied before you make the next request. For example, you might want to fetch a user's ID and profile information first. Once you have the ID, you might then proceed to fetch their list of friends. In this case, each request is contingent on the data returned from the previous request.

However, this behavior can also be unintentional and impact performance.

A common way to avoid waterfalls is to initiate all data requests at the same time - in parallel.

In JavaScript, you can use the `Promise.all()` or `Promise.allSettled()` functions to initiate all promises at the same time. For example, in `data.ts`, we're using `Promise.all()` in the `fetchCardData()` function:

```tsx
export async function fetchCardData() {
  try {
    const invoiceCountPromise = sql`SELECT COUNT(*) FROM invoices`;
    const customerCountPromise = sql`SELECT COUNT(*) FROM customers`;
    const invoiceStatusPromise = sql`SELECT
         SUM(CASE WHEN status = 'paid' THEN amount ELSE 0 END) AS "paid",
         SUM(CASE WHEN status = 'pending' THEN amount ELSE 0 END) AS "pending"
         FROM invoices`;
 
    const data = await Promise.all([
      invoiceCountPromise,
      customerCountPromise,
      invoiceStatusPromise,
    ]);
    // ...
  }
}
```

By using this pattern, you can:

- Start executing all data fetches at the same time, which is faster than waiting for each request to complete in a waterfall.
- Use a native JavaScript pattern that can be applied to any library or framework.

### STATIC VS DYNAMIC REDERING

**What is Static Rendering?**
With static rendering, data fetching and rendering happens on the server at build time (when you deploy) or when revalidating data.

Whenever a user visits your application, the cached result is served. There are a couple of benefits of static rendering:

- Faster Websites - Prerendered content can be cached and globally distributed when deployed to platforms like Vercel. This ensures that users around the world can access your website's content more quickly and reliably.
- Reduced Server Load - Because the content is cached, your server does not have to dynamically generate content for each user request. This can reduce compute costs.
- SEO - Prerendered content is easier for search engine crawlers to index, as the content is already available when the page loads. This can lead to improved search engine rankings.
- Static rendering is useful for UI with no data or data that is shared across users, such as a static blog post or a product page. It might not be a good fit for a dashboard that has personalized data which is regularly updated.

The opposite of static rendering is dynamic rendering.

**What is Dynamic Rendering?**
With dynamic rendering, content is rendered on the server for each user at request time (when the user visits the page). There are a couple of benefits of dynamic rendering:

- Real-Time Data - Dynamic rendering allows your application to display real-time or frequently updated data. This is ideal for applications where data changes often.
- User-Specific Content - It's easier to serve personalized content, such as dashboards or user profiles, and update the data based on user interaction.
- Request Time Information - Dynamic rendering allows you to access information that can only be known at request time, such as cookies or the URL search parameters.

## STREAMING
**What is streaming?**
Streaming is a data transfer technique that allows you to break down a route into smaller "chunks" and progressively stream them from the server to the client as they become ready.

By streaming, you can prevent slow data requests from blocking your whole page. This allows the user to see and interact with parts of the page without waiting for all the data to load before any UI can be shown to the user.

### LOADING
next has a special file built on top of `React Suspense`. Who allow us to create fallback UI to show as a replacement while page content loads.

Just by creating a page `app/dashboard/loading.tsx`:
```tsx
export default function Loading() {
  return <div>Loading...</div>;
}
```
we already have this loading page while data inside dashboard is fethching. 
Since `<SideNav>` is static, it's shown immediately. The user can interact with `<SideNav>` while the dynamic content is loading.

To make it prettier we could add an skeleton:
```tsx
import DashboardSkeleton from "../ui/skeletons";

export default function Loading() {
    return <DashboardSkeleton />;
}
```

Considering that we want to use only for our `dashboard` page and not for `invoices` or customer, we can use
`Route Groups` by creating a folder with parentheses `()`  that is not included on path. So /dashboard/(overview)/page.tsx becomes /dashboard.

### REACT SUSPENSE
React suspense provides a granular way to load parts of your applications.
Here's the example of a chart:
```tsx
<Suspense fallback={<RevenueChartSkeleton />}>
    <RevenueChart />
</Suspense>
```

in these case, we made `RevenueChart` responsable for his own datafetch and set a `Skeleton` for his fallback.