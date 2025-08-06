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