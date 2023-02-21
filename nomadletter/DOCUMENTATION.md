# Below you'll find documentation of our custom classes.

The following classes are independent of Tailwind CSS, exclusive to TemplateHub and are made specifically so that you have to worry less about design related details when building out your projects. 

_Keep in mind that elements needs its name stated as a class in order to inherit colors and other properties, eg:_

```html
<button class="button button-md"></button>
<input class="input input-lg"></input>
<a href="#" class="link link-xl"></a>
```

We use a sizing convention that spans from XS to XL, where the text sizing is consistent for every size regardless of element. This gives non-designers an easier time when trying to pair elements in your layouts, should you want to customize the HTML structure and create new pages. 

For example, when building a section with a _body text_, _a button_ and _a link_ one could use the same sizing for all the elements:

```html
<p class="body-xl">This is a classic message.</p>
<button class="button button-xl">A button</button>
<a href="#" class="link link-xl">A link</a>
```


## Buttons

Available classes:
- .button-xl
- .button-lg
- .button-md
- .button-sm
- .button-xs

### Usage
```html
<button class="button button-md">Button</button>
```

*Note: that the class button is needed for the colors*

## Inputs

Available classes:
* .input-xl
* .input-lg
* .input-md
* .input-sm
* .input-xs

### Usage
```html
<input class="input input-md">Input</input>
```

*Note: that the class input is needed for the colors*

## Links

Available classes:
* .link-xl
* .link-lg
* .link-md
* .link-sm
* .link-xs

### Usage
```html
<a href="#" class="link link-md">A link</a>
```

*Note: that the class link is needed for the colors*

## Headings
Note: Heading classes with size specification should be associated with its respective element except for mega which should be used with h1.


```html
.mega       <h1 class="mega">

.h1         <h1 class="h1">

.h2         <h2 class="h2">

.h3         <h3 class="h3">

.h4         <h4 class="h4">

.h5         <h5 class="h5">

.h6         <h6 class="h6">
```

## Body

Available classes:
* .body-xl
* .body-lg
* .body-md
* .body-sm
* .body-xs

### Usage
```html
<a class="body-md">A link</a>
```


## Colors

You can change colors using our custom classes. By wrapping some of the elements in these classes, colors will change for some elements. The following classes are:
- .header
- .footer
- .overlay


### Usage
```html

<!-- Elements without a wrapper class has base colors -->
<div>
	<a class="link link-md">A link</a>
	<button class="button button-md">Button</button>
	<input class="input input-md">Input</input>
	<p class="body-md">Some text</p>
</div>

<!-- Elements wrapped in the .header class has different colors -->
<header class="header">
	<a class="link link-md">A link</a>
	<button class="button button-md">Button</button>
	<input class="input input-md">Input</input>
	<p class="body-md">Some text</p>
</header>

<!-- Elements wrapped in the .overlay has different colors -->
<div class="bg-overlay overlay">
	<a class="link link-md">A link</a>
	<button class="button button-md">Button</button>
	<input class="input input-md">Input</input>
	<p class="body-md">Some text</p>
</div>

<!-- Elements wrapped in the .footer has different colors -->
<footer class="footer">
	<a class="link link-md">A link</a>
	<button class="button button-md">Button</button>
	<input class="input input-md">Input</input>
	<p class="body-md">Some text</p>
</footer>


```


If you have any questions, feel free to email us at hi@templatehub.store!
