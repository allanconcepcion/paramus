import { useEffect } from 'react'
import * as CookieConsent from 'vanilla-cookieconsent'

const CookiesConsent = () => {
  useEffect(() => {  
    /**
     * All config. options available here:
     * https://cookieconsent.orestbida.com/reference/configuration-reference.html
     */
    CookieConsent.run({

      // root: 'body',
      // autoShow: true,
      // disablePageInteraction: true,
      // hideFromBots: true,
      // mode: 'opt-in',
      // revision: 0,

      cookie: {
        name: 'cc_cookie',
        // domain: location.hostname,
        // path: '/',
        // sameSite: "Lax",
        // expiresAfterDays: 365,
      },

      // https://cookieconsent.orestbida.com/reference/configuration-reference.html#guioptions
      guiOptions: {
        consentModal: {
          layout: 'box',
          position: 'bottom left',
          equalWeightButtons: false,
          flipButtons: false
        },
        preferencesModal: {
          layout: 'box',
          equalWeightButtons: false,
          flipButtons: false
        }
      },      
      categories: {
        necessary: {
          enabled: true, // this category is enabled by default
          readOnly: true // this category cannot be disabled
        },
        analytics: {
          enabled: true, // this category is enabled by default,
          autoClear: {
            cookies: [{
                name: /^_ga/, // regex: match all cookies starting with '_ga'
              },
              {
                name: '_gid', // string: exact cookie name
              }
            ]
          },

          // https://cookieconsent.orestbida.com/reference/configuration-reference.html#category-services
          services: {
            ga: {
              label: 'Google Analytics',              
              onAccept: () => {
                
              },
              onReject: () => {
              },
              cookies: [
                {
                  name: /^(_ga|_gid)/
                }
              ]
            },
            facebook: {
              label: 'Facebook',              
              onAccept: () => {
                if ( typeof fbq !== 'undefined' ) {
                  fbq('consent', 'grant')
                }                
              },
              onReject: () => {
                if ( typeof fbq !== 'undefined' ) {
                  fbq('consent', 'revoke')
                }                
              }
            },
          }
        }        
      },

      language: {
        default: 'en',
        translations: {
          en: {
            consentModal: {
              title: 'We use cookies',
              description: 'Click “Accept All” to enable us to use cookies to personalize this site. Customize your preferences in Manage Preferences or click “Reject All” if you do not want us to use cookies for this purpose.',
              acceptAllBtn: 'Accept all',
              acceptNecessaryBtn: 'Reject all',
              showPreferencesBtn: 'Manage preferences',
              // closeIconLabel: 'Reject all and close modal',
              footer: `                
                <a href="/privacy-policy">Privacy Policy</a>
              `,
            },
            preferencesModal: {
              title: 'Manage cookie preferences',
              acceptAllBtn: 'Accept all',
              acceptNecessaryBtn: 'Reject all',
              savePreferencesBtn: 'Accept current selection',
              closeIconLabel: 'Close modal',
              serviceCounterLabel: 'Service|Services',
              sections: [{
                  title: 'Your Privacy Choices',
                  description: `In this panel you can express some preferences related to the processing of your personal information. You may review and change expressed choices at any time by resurfacing this panel via the provided link. To deny your consent to the specific processing activities described below, switch the toggles to off or use the “Reject all” button and confirm you want to save your choices.`,
                },
                {
                  title: 'Strictly Necessary',
                  description: 'These cookies are essential for the proper functioning of the website and cannot be disabled.',

                  //this field will generate a toggle linked to the 'necessary' category
                  linkedCategory: 'necessary'
                },
                {
                  title: 'Performance and Analytics',
                  description: 'These cookies collect information about how you use our website. All of the data is anonymized and cannot be used to identify you.',
                  linkedCategory: 'analytics',                  
                }                
              ]
            }
          }
        }
      }
    })
  }, [])

  return (
    <></>
  )
}

export default CookiesConsent