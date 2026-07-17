import { useRouter } from 'next/router'
import { useEffect } from 'react'
import _App from 'next/app'
import { ParallaxProvider } from 'react-scroll-parallax'
import Head from 'next/head'
import get from 'lodash/get'
import 'url-polyfill'

import AppProvider from 'providers/App'
import { GQL_CUSTOMIZE_SEO } from 'components/SEO'
import { GQL_MENU, GQL_CUSTOMIZE_MENU } from 'components/Menu'
import { GQL_MOBILE_MENU, GQL_CUSTOMIZE_MOBILE_MENU } from 'components/MobileMenu'
import { GQL_SOCIAL_MENU } from 'components/SocialMenu'
import { GQL_CUSTOMIZE_HEADER } from 'components/Header'
import { GQL_CUSTOMIZE_HERO } from 'components/modules/Hero'
import { GQL_CUSTOMIZE_FOOTER } from 'components/Footer'
import { GQL_CUSTOMIZE_FORM } from 'components/Form'
import { GQL_CUSTOMIZE_POST } from 'components/Post'
import { GQL_CUSTOMIZE_VIDEO_MODAL } from 'components/VideoModal'
import { GQL_CUSTOMIZE_VIDEO } from 'components/WPVideo'
import { GQL_CUSTOMIZE_MODALS } from 'components/Modals'
import { GQL_CUSTOMIZE_TEXT_MODULE } from 'components/modules/Text'
import { GQL_CUSTOMIZE_HORIZONTAL_ACCORDION_MODULE } from 'components/modules/HorizontalAccordion'
import { GQL_CUSTOMIZE_ACCORDION_MODULE } from 'components/modules/Accordion'
import { GQL_CUSTOMIZE_VIDEO_CAROUSEL_MODULE } from 'components/modules/VideoCarousel'
import { GQL_CUSTOMIZE_TIMELINE_MODULE } from 'components/modules/Timeline'
import { GQL_CUSTOMIZE_MEDIA_TEXT_MODULE } from 'components/modules/MediaText'
import { GQL_CUSTOMIZE_MEDIA_TEXT_2X_MODULE } from 'components/modules/MediaText2x'
import { GQL_CUSTOMIZE_CARDS_MODULE } from 'components/modules/Cards'
import { GQL_CUSTOMIZE_CARD_CAROUSEL_MODULE } from 'components/modules/CardCarousel'
import { GQL_CUSTOMIZE_GALLERY_MODULE } from 'components/modules/Gallery'
import { GQL_CUSTOMIZE_CARD_TABS_MODULE } from 'components/modules/CardTabs'
import { GQL_CUSTOMIZE_VIDEO_GALLERY_MODULE } from 'components/modules/VideoGallery'
import { GQL_CUSTOMIZE_ICON_BLOCKS_MODULE } from 'components/modules/IconBlocks'
import { GQL_CUSTOMIZE_HTML_MODULE } from 'components/modules/Html'

import { GQL_ACF_TYPOGRAPHY } from 'utils/graphql'
import cms from 'lib/cms'
import { safeHtmlParser } from 'utils/dom'

import 'lazysizes'
import 'lazysizes/plugins/attrchange/ls.attrchange'
import 'vanilla-cookieconsent/dist/cookieconsent.css'
import 'scss/app.scss'

const App = ({
  Component,
  pageProps,
  customize,
  forms, 
  formsSettings, 
  menu,
  mobileMenu, 
  socialMenu, 
  plugins
}) => {       
  const router = useRouter()

  const hasGoogleReviews = plugins.find(
    p => p.path === 'wp-reviews-plugin-for-google/wp-reviews-plugin-for-google.php'
  )

  const initGoogleReviews = () => {
    (function init() {      
      if ( typeof Trustindex === 'undefined' ) {
        return setTimeout(init, 100)
      }

      if ( typeof Trustindex.pager_inited !== 'undefined' ) {
        return false
      }

      setTimeout(() => 
        Trustindex.init_pager(document.querySelectorAll('.ti-widget')), 
        200
      )
    })()

    document.querySelectorAll('pre.ti-widget')
      .forEach(item => item.replaceWith(item.firstChild))
  }

  const routeChangeStart = () => {
    document.documentElement.classList.add('is-loading')
  }

  const routeChangeComplete = () => {
    document.documentElement.classList.remove('is-loading')

    if ( hasGoogleReviews ) {
      initGoogleReviews()
    }    
  }

  useEffect(() => {
    router.events.on('routeChangeStart', routeChangeStart)
    router.events.on('routeChangeComplete', routeChangeComplete)
    
    return () => {
      router.events.off('routeChangeStart', routeChangeStart)
      router.events.off('routeChangeComplete', routeChangeComplete)
    }
  }, [router.events])
    
  return (
    <>
    <Head>          
    {customize.seo.gtmContainers?.map((container, k) => (
      <script
          key={`script-${k}`}
          dangerouslySetInnerHTML={{
            __html: `(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','${container.id}');`
          }}
      />
    ))}
    {hasGoogleReviews && (
      <>
        <link rel="stylesheet" id="ti-widget-css-google-css" href="https://www.whiteridgedental.com/wp-content/uploads/trustindex-google-widget.css?ver=1716581605" type="text/css" media="all"></link>
        <script type="text/javascript" defer="" async="" src="https://cdn.trustindex.io/loader.js?ver=6.4.5" id="trustindex-js-js"></script>
      </>
    )}    
    {customize.seo.headerHtml && safeHtmlParser(customize.seo.headerHtml)}    
            <meta name="viewport" content="width=device-width, initial-scale=1" />
      </Head>        
    
    {customize.seo.gtmContainers?.map((container, k) => (
       <noscript
           key={`noscript-${k}`}
       >
         <iframe
             src={`https://www.googletagmanager.com/ns.html?id=${container.id}`}
             height="0"
             width="0"
             style={{
               display: 'none',
               visibility: 'hidden'
             }}
         />
       </noscript>
     ))}
    
    
    <AppProvider
      forms={forms}
      formsSettings={formsSettings}
      menu={menu}
      mobileMenu={mobileMenu}
      socialMenu={socialMenu}
      customize={customize}
    >
      <ParallaxProvider>
        <Component {...pageProps} key={router.asPath} />
      </ParallaxProvider>
    </AppProvider>
    
    {customize.seo.footerHtml && (
      <div dangerouslySetInnerHTML={{ __html: customize.seo.footerHtml }} />  
    )}    
    </>
  )
}

App.getInitialProps = async ( appContext ) => {
  const appProps = await _App.getInitialProps(appContext)

  const app = await cms(`
    ${GQL_CUSTOMIZE_SEO}
    ${GQL_CUSTOMIZE_HEADER}        
    ${GQL_CUSTOMIZE_MENU}    
    ${GQL_CUSTOMIZE_MOBILE_MENU}
    ${GQL_CUSTOMIZE_HERO}
    ${GQL_CUSTOMIZE_FOOTER}
    ${GQL_CUSTOMIZE_FORM}
    ${GQL_CUSTOMIZE_POST}
    ${GQL_CUSTOMIZE_VIDEO_MODAL}
    ${GQL_CUSTOMIZE_VIDEO}
    ${GQL_CUSTOMIZE_MODALS}
    ${GQL_CUSTOMIZE_TEXT_MODULE}
    ${GQL_CUSTOMIZE_HORIZONTAL_ACCORDION_MODULE('A')}
    ${GQL_CUSTOMIZE_HORIZONTAL_ACCORDION_MODULE('B')}
    ${GQL_CUSTOMIZE_ACCORDION_MODULE('A')}
    ${GQL_CUSTOMIZE_ACCORDION_MODULE('B')}
    ${GQL_CUSTOMIZE_ACCORDION_MODULE('C')}
    ${GQL_CUSTOMIZE_VIDEO_CAROUSEL_MODULE('A')}
    ${GQL_CUSTOMIZE_VIDEO_CAROUSEL_MODULE('B')}
    ${GQL_CUSTOMIZE_TIMELINE_MODULE('A')}
    ${GQL_CUSTOMIZE_TIMELINE_MODULE('B')}
    ${GQL_CUSTOMIZE_TIMELINE_MODULE('C')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_MODULE('A')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_MODULE('B')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_MODULE('C')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_2X_MODULE('A')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_2X_MODULE('B')}
    ${GQL_CUSTOMIZE_MEDIA_TEXT_2X_MODULE('C')}
    ${GQL_CUSTOMIZE_CARDS_MODULE('A')}
    ${GQL_CUSTOMIZE_CARDS_MODULE('B')}
    ${GQL_CUSTOMIZE_CARDS_MODULE('C')}
    ${GQL_CUSTOMIZE_CARD_CAROUSEL_MODULE('A')}
    ${GQL_CUSTOMIZE_CARD_CAROUSEL_MODULE('B')}
    ${GQL_CUSTOMIZE_CARD_CAROUSEL_MODULE('C')}
    ${GQL_CUSTOMIZE_GALLERY_MODULE('A')}
    ${GQL_CUSTOMIZE_GALLERY_MODULE('B')}
    ${GQL_CUSTOMIZE_GALLERY_MODULE('C')}
    ${GQL_CUSTOMIZE_CARD_TABS_MODULE('A')}
    ${GQL_CUSTOMIZE_CARD_TABS_MODULE('B')}
    ${GQL_CUSTOMIZE_CARD_TABS_MODULE('C')}
    ${GQL_CUSTOMIZE_VIDEO_GALLERY_MODULE('A')}
    ${GQL_CUSTOMIZE_ICON_BLOCKS_MODULE}
    ${GQL_CUSTOMIZE_HTML_MODULE('A')}
    ${GQL_CUSTOMIZE_HTML_MODULE('B')}
    ${GQL_CUSTOMIZE_HTML_MODULE('C')}
    ${GQL_MENU}
    ${GQL_MOBILE_MENU}
    ${GQL_SOCIAL_MENU}

    query {      
      menu: menuItems(
        first: 10, 
        where: {
          location: MAIN, 
          parentDatabaseId: 0
        }
      ) {
        nodes {
          ...Menu           
        }
      }

      mobileMenu: menuItems(
        first: 10, 
        where: {
          location: MOBILE, 
          parentDatabaseId: 0
        }
      ) {
        nodes {
          ...MobileMenu           
        }
      }

      socialMenu: menuItems(
        first: 10, 
        where: {
          location: SOCIAL, 
          parentDatabaseId: 0
        }
      ) {
        nodes {
          ...SocialMenu
        }
      }

      customize {
        global {
          bodyDesktop {
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          bodyMobile {
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          buttonDesktop {
            ${GQL_ACF_TYPOGRAPHY('large')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          buttonMobile {
            ${GQL_ACF_TYPOGRAPHY('large')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          fontFamilies {
            family
            label
          }
          h1Desktop {
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h1Mobile {
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h2Desktop {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h2Mobile {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h3Desktop {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('extraBold')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h3Mobile {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('extraBold')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h4Desktop {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('light')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h4Mobile {
            ${GQL_ACF_TYPOGRAPHY('bold')}
            ${GQL_ACF_TYPOGRAPHY('light')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h5Desktop {
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h5Mobile {          
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h6Desktop {
            ${GQL_ACF_TYPOGRAPHY('light')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          h6Mobile {          
            ${GQL_ACF_TYPOGRAPHY('light')}
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          colors {
            color
            name
          }
          hyperlinkColor
          overrideListBulletColor
          listBulletColor
          hyperlinkFontWeight
          imageCaptionsDesktop {                      
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          imageCaptionsMobile {                      
            ${GQL_ACF_TYPOGRAPHY('regular')}
          }
          typographyEmbed
        }
        ...CustomizeSEO
        ...CustomizHeader
        ...CustomizeMenu
        ...CustomizeMobileMenu
        ...CustomizeFooter

        modules {
          ...CustomizeHero
          ...CustomizeTextModule
          ...CustomizeHorizontalAccordionAModule
          ...CustomizeHorizontalAccordionBModule
          ...CustomizeAccordionAModule
          ...CustomizeAccordionBModule
          ...CustomizeAccordionCModule
          ...CustomizeVideoCarouselAModule
          ...CustomizeVideoCarouselBModule
          ...CustomizeTimelineAModule
          ...CustomizeTimelineBModule
          ...CustomizeTimelineCModule
          ...CustomizeMediaTextAModule
          ...CustomizeMediaTextBModule
          ...CustomizeMediaTextCModule
          ...CustomizeMediaText2xAModule
          ...CustomizeMediaText2xBModule
          ...CustomizeMediaText2xCModule
          ...CustomizeCardsAModule
          ...CustomizeCardsBModule
          ...CustomizeCardsCModule
          ...CustomizeCardCarouselAModule
          ...CustomizeCardCarouselBModule
          ...CustomizeCardCarouselCModule
          ...CustomizeGalleryAModule
          ...CustomizeGalleryBModule
          ...CustomizeGalleryCModule
          ...CustomizeCardTabsAModule
          ...CustomizeCardTabsBModule
          ...CustomizeCardTabsCModule
          ...CustomizeVideoGalleryAModule
          ...CustomizeIconBlocksModule
          ...CustomizeHtmlAModule
          ...CustomizeHtmlBModule
          ...CustomizeHtmlCModule
        }

        components {
          ...CustomizeForm
          ...CustomizePost
          ...CustomizeVideoModal
          ...CustomizeVideo
        }

        modals {
          ...CustomizeModals
        }
      }

      forms: gfForms(
        first: 50
      ) {
        nodes {
          id
          databaseId
          formFields {
            nodes {
              id
              type
              layoutGridColumnSpan
              ... on EmailField {
                errorMessage
                isRequired
                label     
              }
              ... on PhoneField {
                errorMessage
                isRequired
                label
                phoneFormat
              }
              ...on NumberField {
                errorMessage
                isRequired
                label
              }
              ... on TextField {
                defaultValue
                errorMessage
                isRequired
                label
              }
              ... on TextAreaField {
                defaultValue
                errorMessage
                isRequired
                label
              }
              ... on RadioField {
                errorMessage
                isRequired
                label
                choices {
                  text
                  value
                  isSelected
                }                
              }
              ... on CheckboxField {
                label
                labelPlacement
                layoutGridColumnSpan
                errorMessage
                choices {
                  text
                  value
                  isSelected
                }
                hasSelectAll
                isRequired
              }
              ... on SelectField {
                errorMessage
                isRequired
                label
                placeholder
                choices {
                  text
                  value
                  isSelected
                }
              }
              ... on FileUploadField {
                errorMessage  
                isRequired
                label
                description
                canAcceptMultipleFiles
                maxFiles
                maxFileSize
                allowedExtensions
              }
              ... on HiddenField {
                defaultValue
                label 
              }
              ... on HtmlField {                
                label              
                content
                cssClass
              }
              ... on CaptchaField {                
                captchaBadgePosition
                captchaLanguage
                captchaTheme
                captchaType              
                layoutGridColumnSpan
              }
              ... on DateField {
                dateFormat
                dateType
                label
                isRequired
                errorMessage
                inputs {
                  defaultValue
                  label
                  placeholder
                }
              }
            }
          }
          confirmations {
            isActive
            isDefault
            message            
            name
            queryString
            type
            url           
            conditionalLogic {
              actionType
              logicType
              rules {
                fieldId
                operator
                value
              }
            }
          }
          submitButton {
            text
            layoutGridColumnSpan
          }
        }
      }
      formsSettings: gfSettings {
        recaptcha {
          publicKey    
          type
        }
      }
      plugins(first: 100) {
        nodes {
          path
        }
      }
    }
  `, null, true)     
            
  return {
    customize: get(app, 'data.customize'),
    forms: get(app, 'data.forms.nodes'),
    formsSettings: get(app, 'data.formsSettings'),
    menu: get(app, 'data.menu.nodes'),    
    mobileMenu: get(app, 'data.mobileMenu.nodes'),    
    socialMenu: get(app, 'data.socialMenu.nodes'),    
    plugins: get(app, 'data.plugins.nodes'),    
    ...appProps
  }
}

export default App
