# EUCookieLawBundle

## Description

this bundle allow you to add the information message for your users about the cookies. 
It's a requirement since the [ePrivacy directive](http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm#section_2)

## Installation

* install the bundle

```bash
composer require leblanc-simon/eu-cookie-law-bundle
```

* activate the bundle

```php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new LeblancSimon\EUCookieLawBundle\LeblancSimonEUCookieLawBundle(),
        ];
    }
}
```

Nothing else to do. The HTML will be automatically injected for the text/html response.

## Customization

### Message

The message and text button can be customized via translation. Add a 
```Resources/translations/EUCookieLaw.[locale].yml``` in your project and customize your text.
 
```yml
cookie_law:
    message: |
        Afin de vous proposer le meilleur service possible, ce site utilise des cookies.
        En acceptant de continuer sur ce site, vous déclarer accepter leur utilisation.
    accept: J'accepte
    read_more: Voir plus
```

### Design

to override the design, use id in your CSS files : 

```css
#eu-cookie-law {

}
#eu-cookie-law-accept {

}
```

### Configuration

you can customized the bundle with a configuration :

```yml
leblanc_simon_eu_cookie_law:
    # The name of the cookie use to know if the user is agree
    cookie_name: eu_cookie_law
    # The value of the cookie use to know if the user is agree
    cookie_value: accept
    # The template use to show the message
    template: 'LeblancSimonEUCookieLawBundle::eu_cookie_law.html.twig'
    # The name of route to be open
    read_more_link: name_to_route
```
