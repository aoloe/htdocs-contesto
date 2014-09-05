# htdocs-contesto

## about kai's maquette

- proposal on http://contesto.illustration.ch/
- the local css changes are in udt-custom-content

## work

- 16 july: 5h (grok the html, the css, the splashscreen and the navigation)
- 17 july: 2h (add the content style and markdown)
- 24 august: 1h (fill all the pages with content)
- 28 august: 1h (move the languages below the navigation)

## todo

- add the preventivo, devis, offerte, estimate
- when the splash gets too small, put the logo below the drawing
- implement the responsive variants
- process the contact form (cf. old site)
- correctly format the footer (logo in the middle, address + by with margin)
- should the splash screen image be bigger? -> anchor the slider to the bottom of the page
- fix the missing italics

further tasks:

- check that the language selection / cookies is working correctly
- simplify the styles in the navigations uls and lis
- add also local fonts (+cdn)
- add kai's honey pot to the contact form?
- dynamically define the alternate page (what is it good for?)
      <meta name="generator" content="WPML ver:3.0.1 stt:4,1,3,27;0" />
      <link rel="alternate" hreflang="it-IT" href="http://contesto.illustration.ch/it/profilo/" />
      <link rel="alternate" hreflang="de-DE" href="http://contesto.illustration.ch/de/profil/" />
      <link rel="alternate" hreflang="fr-FR" href="http://contesto.illustration.ch/fr/qui-sommes-nous/" />
      <link rel="alternate" hreflang="en-US" href="http://contesto.illustration.ch/about/" />
- really gray as a the text color? testare...
- should there be a way to go back to the splash screen? the logo should go back for a few month!
  - add kai's images on the about page

## Upload

    mkdir php-cache
    mkdir php-cookie
    mkdir php-debug
    mkdir php-markdown
    mkdir php-module
    mkdir php-route
    mkdir php-site
    mkdir php-template
    mkdir php-cache/src
    mkdir php-cookie/src
    mkdir php-debug/src
    mkdir php-markdown/src
    mkdir php-module/src
    mkdir php-route/src
    mkdir php-site/src
    mkdir php-template/src
    cd php-cache/src
    put -f php-cache/src/Cache.php
    cd ../..
    cd php-cookie/src
    put -f php-cookie/src/Cookie.php
    cd ../..
    cd php-debug/src
    put -f php-debug/src/Debug.php
    cd ../..
    cd php-markdown/src
    put -f php-markdown/src/Markdown.php
    cd ../..
    cd php-module/src
    put -f php-module/src/Module.php
    cd ../..
    cd php-route/src
    put -f php-route/src/Route.php
    cd ../..
    cd php-site/src
    put -f php-site/src/Site.php
    cd ../..
    cd php-template/src
    put -f php-template/src/Template.php
    cd ../..
