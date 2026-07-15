import Document, { Html, Head, Main, NextScript } from 'next/document'
import { ServerStyleSheet } from 'styled-components'
import get from 'lodash/get'

import SVGIcons from 'components/SVGIcons'
import cms from 'lib/cms'

export default class MyDocument extends Document {
  static async getInitialProps(ctx) {
    const sheet = new ServerStyleSheet()
    const originalRenderPage = ctx.renderPage

    try {
      ctx.renderPage = () =>
        originalRenderPage({
          enhanceApp: (App) => (props) =>
            sheet.collectStyles(<App {...props} />),
        })

      const initialProps = await Document.getInitialProps(ctx)

      const languageResponse = await cms(`
        {
          allSettings {
            generalSettingsLanguage
          }
        }
      `)

      const lang = get(languageResponse, 'data.allSettings.generalSettingsLanguage') || 'en-US'    

      return {
        ...initialProps,
        lang,
        styles: [initialProps.styles, sheet.getStyleElement()],
      }
    } finally {
      sheet.seal()
    }
  }

  render () {    
    return (
      <Html lang={this.props.lang}>
        <Head>
          <link href="/fontawesome/css/all.min.css" rel="stylesheet" />
        </Head>
        <body>          
          <Main />
          <NextScript />
        </body>

        <SVGIcons />      
      </Html>
    )
  }
}