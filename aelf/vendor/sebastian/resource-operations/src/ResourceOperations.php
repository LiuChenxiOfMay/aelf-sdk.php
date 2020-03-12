{
  "_from": "ansi-styles@^3.2.1",
  "_id": "ansi-styles@3.2.1",
  "_inBundle": false,
  "_integrity": "sha512-VT0ZI6kZRdTh8YyJw3SMbYm/u+NqfsAxEpWO0Pf9sq8/e94WxxOpPKx9FR1FlyCtOVDNOQ+8ntlqFxiRc+r5qA==",
  "_location": "/ansi-styles",
  "_phantomChildren": {},
  "_requested": {
    "type": "range",
    "registry": true,
    "raw": "ansi-styles@^3.2.1",
    "name": "ansi-styles",
    "escapedName": "ansi-styles",
    "rawSpec": "^3.2.1",
    "saveSpec": null,
    "fetchSpec": "^3.2.1"
  },
  "_requiredBy": [
    "/chalk"
  ],
  "_resolved": "https://registry.npmjs.org/ansi-styles/-/ansi-styles-3.2.1.tgz",
  "_shasum": "41fbb20243e50b12be0f04b8dedbf07520ce841d",
  "_spec": "ansi-styles@^3.2.1",
  "_where": "/Users/sindresorhus/dev/oss/sublime-autoprefixer/node_modules/chalk",
  "author": {
    "name": "Sindre Sorhus",
    "email": "sindresorhus@gmail.com",
    "url": "sindresorhus.com"
  },
  "ava": {
    "require": "babel-polyfill"
  },
  "bugs": {
    "url": "https://github.com/chalk/ansi-styles/issues"
  },
  "bundleDependencies": false,
  "dependencies": {
    "color-convert": "^1.9.0"
  },
  "deprecated": false,
  "description": "ANSI escape codes for styling strings in the terminal",
  "devDependencies": {
    "ava": "*",
    "babel-polyfill": "^6.23.0",
    "svg-term-cli": "^2.1.1",
    "xo": "*"
  },
  "engines": {
    "node": ">=4"
  },
  "files": [
    "index.js"
  ],
  "homepage": "https://github.com/chalk/ansi-styles#readme",
  "keywords": [
    "ansi",
    "styles",
    "color",
    "colour",
    "colors",
    "terminal",
    "console",
    "cli",
    "string",
    "tty",
    "escape",
    "formatting",
    "rgb",
    "256",
    "shell",
    "xterm",
    "log",
    "logging",
    "command-line",
    "text"
  ],
  "license": "MIT",
  "name": "ansi-styles",
  "repository": {
    "type": "git",
    "url": "git+https://github.com/chalk/ansi-styles.git"
  },
  "scripts": {
    "screenshot": "svg-term --command='node screenshot' --out=screenshot.svg --padding=3 --width=55 --height=3 --at=1000 --no-cursor",
    "test": "xo && ava"
  },
  "version": "3.2.1"
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               # ansi-styles [![Build Status](https://travis-ci.org/chalk/ansi-styles.svg?branch=master)](https://travis-ci.org/chalk/ansi-styles)

> [ANSI escape codes](http://en.wikipedia.org/wiki/ANSI_escape_code#Colors_and_Styles) for styling strings in the terminal

You probably want the higher-level [chalk](https://github.com/chalk/chalk) module for styling your strings.

<img src="https://cdn.rawgit.com/chalk/ansi-styles/8261697c95bf34b6c7767e2cbe9941a851d59385/screenshot.svg" width="900">


## Install

```
$ npm install ansi-styles
```


## Usage

```js
const style = require('ansi-styles');

console.log(`${style.green.open}Hello world!${style.green.close}`);


// Color conversion between 16/256/truecolor
// NOTE: If conversion goes to 16 colors or 256 colors, the original color
//       may be degraded to fit that color palette. This means terminals
//       that do not support 16 million colors will best-match the
//       original color.
console.log(style.bgColor.ansi.hsl(120, 80, 72) + 'Hello world!' + style.bgColor.close);
console.log(style.color.ansi256.rgb(199, 20, 250) + 'Hello world!' + style.color.close);
console.log(style.color.ansi16m.hex('#ABCDEF') + 'Hello world!' + style.color.close);
```

## API

Each style has an `open` and `close` property.


## Styles

### Modifiers

- `reset`
- `bold`
- `dim`
- `italic` *(Not widely supported)*
- `underline`
- `inverse`
- `hidden`
- `strikethrough` *(Not widely supported)*

### Colors

- `black`
- `red`
- `green`
- `yellow`
- `blue`
- `magenta`
- `cyan`
- `white`
- `gray` ("bright black")
- `redBright`
- `greenBright`
- `yellowBright`
- `blueBright`
- `magentaBright`
- `cyanBright`
- `whiteBright`

### Background colors

- `bgBlack`
- `bgRed`
- `bgGreen`
- `bgYellow`
- `bgBlue`
- `bgMagenta`
- `bgCyan`
- `bgWhite`
- `bgBlackBright`
- `bgRedBright`
- `bgGreenBright`
- `bgYellowBright`
- `bgBlueBright`
- `bgMagentaBright`
- `bgCyanBright`
- `bgWhiteBright`


## Advanced usage

By default, you get a map of styles, but the styles are also available as groups. They are non-enumerable so they don't show up unless you access them explicitly. This makes it easier to expose only a subset in a higher-level module.

- `style.modifier`
- `style.color`
- `style.bgColor`

###### Example

```js
console.log(style.color.green.open);
```

Raw escape codes (i.e. without the CSI escape prefix `\u001B[` and render mode postfix `m`) are available under `style.codes`, which returns a `Map` with the open codes as keys and close codes as values.

###### Example

```js
console.log(style.codes.get(36));
//=> 39
```


## [256 / 16 million (TrueColor) support](https://gist.github.com/XVilka/8346728)

`ansi-styles` uses the [`color-convert`](https://github.com/Qix-/color-convert) package to allow for converting between various colors and ANSI escapes, with support for 256 and 16 million colors.

To use these, call the associated conversion function with the intended output, for example:

```js
style.color.ansi.rgb(100, 200, 15); // RGB to 16 color ansi foreground code
style.bgColor.ansi.rgb(100, 200, 15); // RGB to 16 color ansi background code

style.color.ansi256.hsl(120, 100, 60); // HSL to 256 color ansi foreground code
style.bgColor.ansi256.hsl(120, 100, 60); // HSL to 256 color ansi foreground code

style.color.ansi16m.hex('#C0FFEE'); // Hex (RGB) to 16 million color foreground code
style.bgColor.ansi16m.hex('#C0FFEE'); // Hex (RGB) to 16 million color background code
```


## Related

- [ansi-escapes](https://github.com/sindresorhus/ansi-escapes) - ANSI escape codes for manipulating the terminal


## Maintainers

- [Sindre Sorhus](https://github.com/sindresorhus)
- [Josh Junon](https://github.com/qix-)


## License

MIT
                                                                                                                                                                                                                                                                                                                                                                                                 INDX( 	 ���            (   �  �       �   ��            ��    ` J     ��    ��Q'��C���]�q��Q'���[*o���                       . b i n       ��    h X     ��    ��Q'��VҎ�Md����Q'��ւ*o���                       a n s i - s t y l e s ��    h R     ��    ��Q'��VҎ�Md����Q'��ւ*o���                       A N S I - S ~ 1       ��    p Z     ��    �W R'��y��]�*��X'���~,o���                       a u t o p r e f i x e r      ��    h R     ��    �W R'� y��]�*��X'���~,o���                       A U T O P R ~ 1       ��    ` L     ��    ��Q'��C���]�q��Q'���[*o���                       B I N ~ 1     �    p Z     ��    F�X'��C4�Md��G�Y'��10o���                       b r o w s e r s l i s t       �    h R     ��    F�X'��C4�Md��G�Y'��10o���                       B R O W S E ~ 1       !�    p Z     ��    �+�Y'��f���Md� }�'��-�9o���                       c a n i u s e - l i t e       !�    h R    ��    �+�Y'��f���Md� }�'��-�9o���                       C A N I U S ~ 1       �    ` L     ��    8�'����`�]����'��S�Ao���                       c h a l k     (�    p \     ��    �8��'��j�U�Md�PP�'��c�Ao���                       c o l o r - c o n v e r t     0�    h V     ��    c2U�'����n�Md�D���'��Bo���                       
c o l o r - n a m e   (�    h R     ��    �8��'��j�U�Md�PP�'��c�Ao���                       C O L O R - ~ 1       0�    h R     ��    c2U�'����n�Md�D���'��Bo���                       C O L O R - ~ 2       8�    � j     ��    �N��'���s�]�:��'���)Bo���                       e l e c t r o n - t o - c h r o m i u m       8�    h R     ��    �N��'���s�]�:��'���)Bo���                       E L E C T R ~ 1       B�    � j     ��    ���'���#��Md���E�'���PBo���                       e s c a p e - s t r i n g - r e g e x p                     ��    ���'���#��Md���E�'���PBo��                        E S C A P E ~ 1       G�    h T     ��    k�G�'��/x�]�Ƥ��'���wBo���                       	g e t - s t d i n     G�    h R     ��    k�G�'��/x�]�Ƥ��'���wBo���                       G E T - S T ~ 1       M�    h R     ��    <N��'��̺�Md�3��'���wBo���                       h a s - f l a g       R�    p \     ��    *��'��%��]�Rȶ�'����Do���                       n o d e - r e l e a s e s     R�    h R     ��    *��'��%��] Rȶ�'����Do���                       N O D E - R ~ 1       g�    p `     ��    $ĸ�'������Md����'���Eo���                       n o r m a l i z e - r a n g e g�    h R     ��    $ĸ�'������Md����'���Eo���                       N O R M A L ~ 1       l�    p Z     ��    ۲�'���>��Md�|["�'��"�Eo���                       n u m 2 f r a c t i o n       l�    h R     ��    ۲�'���>��Md�|["�'��"�Eo���                       N U M 2 F R ~ 1       s�    ` P    ��    ��%�'������]�E�V�'��DHo���                       p o s t c s s ��    x h     ��    [�\�'������Md��P��'���Jo���                       p o s t c s s - s a f e - p a r s e r ��    p Z     ��    ���'���`��Md��zC�'��G*Ko���                       p o s t c s s - s c s s       ��    � j     ��    ŝE�'������Md�����'��mxKo���                       p o s t c s s - v a l u e - p a r s e r     ��    h R     ��    [�\�'������Md��P��'���Jo���                      P O S T C S ~ 1       ��    h R     ��    ���'���`��Md��zC�'��G*Ko���                       P O S T C S ~ 2       ��    h R     ��    ŝE�'������Md�����'��mxKo���                       P O S T C S ~ 3       ��    ` N     ��    ����'��D��]�NY��'���;Lo���                       s e m v e r   ��    h V     ��    U��'��U��'��U��'��U��'��                       
s o u r c e - m a p                                                                        # Change Log
This project adheres to [Semantic Versioning](http://semver.org/).

## 9.5.1
* Fix `backdrop-filter` for Edge (by Oleh Aloshkin).
* Fix `min-resolution` media query support in Firefox < 16.

## 9.5 “Draco dormiens nunquam titillandus”
* Add `mask-composite` support (by Semen Levenson).

## 9.4.10
* Add warning for named Grid rows.

## 9.4.9
* Fix `grid-template` and `@media` case (by Bogdan Dolin).

## 9.4.8
* Fix `calc()` support in Grid gap.

## 9.4.7
* Fix infinite loop on mismatched parens.

## 9.4.6
* Fix warning text (by Albert Juhé Lluveras).

## 9.4.5
* Fix `text-decoration-skip-ink` support.

## 9.4.4
* Use `direction` value for `-ms-writing-mode` (by Denys Kniazevych).
* Fix warning text (by @zzzzBov).

## 9.4.3
* Add warning to force `flex-start` instead of `start` (by Antoine du Hamel).
* Fix docs (by Christian Oliff).

## 9.4.2
* Fix Grid autoplacement warning.

## 9.4.1
* Fix unnecessary Flexbox prefixes in Grid elements.

## 9.4 “Advance Australia”
* Add Grid autoplacement for `-ms-` (by Bogdan Dolin).
* Improve docs and warnings (by Daniel Tonon).
* Remove some unnecessary warnings for Grid (by Andrey Alexandrov).

## 9.3.1
* Fix Grid prefixes with `repeat()` value (by Bogdan Dolin).

## 9.3 “Labor omnia vincit”
* Add `place-self` support (by Bogdan Dolin).
* Fix Grid row/column span inheritance bug (by Bogdan Dolin).

## 9.2.1
* Fix broken AST.

## 9.2 “Onyi est glavnaya krepost”
* Add `/* autoprefixer grid: on */` control comment (by Andrey Alexandrov).
* Add duplicate `grid-area` support (by Bogdan Dolin).
* Fix `grid-gap` support for rules with different specifity (by Bogdan Dolin).
* Disable Grid in `@supports` at-rule with non-supported Grid features.
* Improve Grid warnings (by Daniel Tonon).
* Improve docs (by Joshua Hall, Mat Gadd, Roy Revelt, and Ivan).

## 9.1.5
* Remove `@babel/register` from dependencies.

## 9.1.4
* Use Babel 7.

## 9.1.3
* Sort properties in `autoprefixer --info` alphabetically.
* Fix old Firefox gradient prefix.

## 9.1.2
* Fix `autoprefixer --info` in new Node.js.

## 9.1.1
* Retain `grid-gap` through `@media` (by Bogdan Dolin).
* Fix `grid-template` and  `@media` (by Bogdan Dolin).
* Fix Grid areas searching error (by Bogdan Dolin).
* Fix `span X` Grid prefix (by Bogdan Dolin).
* Fix docs (by Eduard Kyvenko).

## 9.1 “Equality before the law”
* Add `background-clip: text` support.
* Fix adding Grid span for IE (by Bogdan Dolin).

## 9.0.2
* Show warning on Grid area names conflict (by Bogdan Dolin).
* Fix documentation (by Sven Wagner).

## 9.0.1
* Fix nested at-rules in Grid prefixes (by Ivan Malov).

## 9.0 “A Mari Usque Ad Mare”
* Remove Node.js 9 and Node.js 4 support.
* Remove IE and “dead” browsers from Babel.
* Use PostCSS 7.0.
* Use Browserslist 4.0.

## 8.6.5
* Do not show Grid warnings if IE was not selected.

## 8.6.4
* Fix `stretch` prefix in Chrome >= 46.

## 8.6.3
* Add warnings for unsupported Grid features.
* Add warnings about wrong Grid properties.
* Add note about `grid` option for grid properties in `autoprefixer --info`.

## 8.6.2
* Fix error during adding Grid prefixes in `@media` (by Evgeny Petukhov).

## 8.6.1
* Fix `grid-template` with media queries (by Evgeny Petukhov).

## 8.6 “Follow Reason”
* Add `gap` support (by Evgeny Petukhov).
* Add two values support for `grid-gap` and `gap` (by Evgeny Petukhov).
* Add `ignoreUnknownVersions` option for Browserslist.

## 8.5.2
* Fix `grid-template` support wit auto row sizes (by Yury Timofeev).

## 8.5.1
* Remove unnecessary warning on `-webkit-fill-available`.

## 8.5 “Muito Nobre e Sempre Leal”
* Add `grid-gap` support (by Evgeny Petukhov).
* Fix radial gradients direction fix.
* Fix docs (by Phani Kandula and Huáng Jùnliàng).

## 8.4.1
* Fix working in old PostCSS versions (by Diablohu).

## 8.4 “Non in aves, sed in angues”
* Add `/* autoprefixer: ignore next */` control comment (by Pavel Vostrikov).

## 8.3 “Benigno Numine”
* Add `@media` support to `grid-template` (by Evgeny Petukhov).
* Fix `radial-gradient` direction warning (by Gustavo Real).

## 8.2 “Ad Astra per Aspera”
* Add `color-adjust` (by Sergey Lysenko, Stanislav Botev, and Yuriy Alekseyev).

## 8.1 “Rex, Familia et Ultio”
* Add `overscroll-behavior` support.
* Add `grid-template` shortcut support (by Evgeny Petukhov).
* Add better `grid-column-end` and `grid-row-end` support (by Evgeny Petukhov).
* Fix Grid properties support in `@supports`.

## 8.0 “Excelsior”
* Use Browserslist 3.0.
* Rename `autoprefixer-info` CLI tool to `autoprefixer --info`.
* Remove `break-*` to `page-break-*` conversion for Firefox.

## 7.2.6
* Fix `-ms-` prefix for grid cells with same `grid-area` (by Evgeny Petukhov).

## 7.2.5
* Fix multiple prefixes in declaration value.

## 7.2.4
* Fix IE 10 support.

## 7.2.3
* Fix `grid-template-areas` in `@media` (by Evgeny Petukhov).

## 7.2.2
* Fix `_autoprefixerDisabled is undefined` issue.

## 7.2.1
* Fix IE and other old JS runtimes support.

## 7.2 “Ordem e Progresso”
* Add `grid-template-areas` support (by Evgeny Petukhov).
* Add `grid-template` support (by Evgeny Petukhov).
* Add `grid-area` support (by Alexey Komarov).
* Add `autoprefixer-info` CLI tool.
* Add wrong `radial-gradient` properties warning.
* Use current working dir on missed `from` in `info()` (by Phil Dokas).
* Fix `grid-row` and `grid-column` support (by Alexey Komarov).
* Do not prefix `reverse` animation direction.
* Improve test coverage (by Dmitry Semigradsky).

## 7.1.6
* Add warning for using `browserslist` option instead of `browsers`.
* Add warning for multiple control comments in the same scope.
* Fix `Invalid array length` error during indent changes.

## 7.1.5
* Fix `::placeholder` prefix for Edge.
* Fix `inherit`/`initial`/`unset` values for `flex-direction`.
* Fix RegExp usage in gradients (by Yet Another Minion).

## 7.1.4
* Fix `radial-gradient` direction conversion.
* Fix `image-set` in `cursor`.

## 7.1.3
* Add warning for old `radial-gradient` direction syntax.

## 7.1.2
* Fix `text-decoration` shortcut support.

## 7.1.1
* Remove non-`-webkit-` intrinsic prefixes in Grid Layout (by 一丝).

## 7.1 “Universitas litterarum”
* Add `unicode-bidi` support.
* Add `-webkit-appearance` support for Edge.
* Add `from` option to `info()`.
* Fix intrinsic widths prefixes in Grid Layout.

## 7.0.1
* Fix Autoprefixer for old JS runtimes.

## 7.0 “Coelestem adspicit lucem”
* Remove node.js 0.12 support.
* Use PostCSS 6.0.
* Use Browserslist 2.
* Use `caniuse-lite` instead of `caniuse-db` (by Ben Briggs).
* Use `^` for Browserslist dependencies, instead of `~`.
* Rewrite project from CoffeeScript to Babel (by Dmitry Semigradsky).
* Disable Grid Layout prefixes for IE by default.
* Fix `-ms-grid-column-align`.
* Move tests to Jest.

## 6.7.7
* Fix `order` for non-digit values.

## 6.7.6
* Fix `font-kerning` (by Chi Vinh Le).

## 6.7.5
* Fix `text-decoration-skip` in iOS (by Chi Vinh Le).
* Fix `clip-path` (by Chi Vinh Le).

## 6.7.4
* Improve `browsers` option perfomance.
* Update CoffeeScript compiler.

## 6.7.3
* Fix compatibility with “Intrinsic & Extrinsic Sizing” spec update.

## 6.7.2
* Do not prefix grid/flexbox in `@supports` on `grid: false`/`flexbox: false`.

## 6.7.1
* Update Browserslist with `last n version` fix.

## 6.7 “Krungthep doot thep saang”
* Add Electron support in browsers list (by Kilian Valkhof).
* Add `flex-flow` partial support for Flexbox 2009 specification.
* Fix browsers `0` version issue in some Can I Use data.

## 6.6.1
* Add metadata to use Autoprefixer in JSS tests (by Chi Vinh Le).

## 6.6 “Kaiyuan”
* Add `browserslist` key in `package.json` support.
* Add support for separated environments in browserslist config.
* Add `browserslist-stats.json` file support to load custom usage statistics.

## 6.5.4
* Fix unitless 0 basis in IE10/IE11 shorthand flex (by Google).

## 6.5.3
* Add error for popular mistake with `browser` option instead of `browsers`.

## 6.5.2
* Clean prefixes data (by Reinaldo Schiehll).

## 6.5.1
* Fix selectors with `:--` prefix support.

## 6.5 “Einigkeit und Recht und Freiheit”
* Add `defaults` keyword to browsers requirements.
* Fix CSS Grid Layout support.
* Fix `align-self` cleaning.

## 6.4.1
* Fix node cloning after some PostCSS plugins.

## 6.4 “Hic et ubique terrarum”
* Add `:any-link` selector support.
* Add `text-decoration-skip` support.
* Add `transition: duration property` support.
* Fix `-webkit-` prefix for `backface-visibility`.
* Fix `rad` unit support in gradients (by 刘祺).
* Fix `transition` support in Opera 12.
* Removed Safari TP Grid prefixes support.

## 6.3.7
* Fix rare `Cannot read property 'constructor' of null` issue.

## 6.3.6
* Add Safari TP prefix support for Grid Layout.

## 6.3.5
* Fix duplicate prefixes for `-ms-interpolation-mode`.

## 6.3.4
* Show users coverage for selected browsers in `info()`.

## 6.3.3
* Fix transition warning.

## 6.3.2
* Fix jspm support (by Sean Anderson).

## 6.3.1
* Fix compatibility with Flexibility polyfill.

## 6.3 “Pro rege et lege”
* Add Grid Layout support.
* Add `text-spacing` support.
* Add `> 10% in my stats` browsers query with custom usage statistics.
* Add options to disable `@supports`, Flexbox or Grid support.
* Fix compatibility with other PostCSS plugins.

## 6.2.3
* Fix error on broken transition with double comma.

## 6.2.2
* Fix issues in broken transitions.

## 6.2.1
* Fix AST error in transition warning (by @jvdanilo).

## 6.2 “Fluctuat nec mergitur”
* Use `fill` instead of `fill-available` according spec cha