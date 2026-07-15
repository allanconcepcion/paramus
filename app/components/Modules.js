import styled from 'styled-components'

import Text, { GQL_TEXT_MODULE } from 'components/modules/Text'
import Video, { GQL_VIDEO_MODULE } from 'components/modules/Video'
import LogoCarousel, { GQL_LOGO_CAROUSEL_MODULE } from 'components/modules/LogoCarousel'
import Cta, { GQL_CTA_MODULE } from 'components/modules/Cta'
import HorizontalAccordion, { GQL_HORIZONTAL_ACCORDION_MODULE } from 'components/modules/HorizontalAccordion'
import Accordion, { GQL_ACCORDION_MODULE } from 'components/modules/Accordion'
import VideoCarousel, { GQL_VIDEO_CAROUSEL_MODULE } from 'components/modules/VideoCarousel'
import Timeline, { GQL_TIMELINE_MODULE } from 'components/modules/Timeline'
import MediaText, { GQL_MEDIA_TEXT_MODULE } from 'components/modules/MediaText'
import MediaText2x, { GQL_MEDIA_TEXT_2X_MODULE } from 'components/modules/MediaText2x'
import Cards, { GQL_CARDS_MODULE } from 'components/modules/Cards'
import CardCarousel, { GQL_CARD_CAROUSEL_MODULE } from 'components/modules/CardCarousel'
import CardTabs, { GQL_CARD_TABS_MODULE } from 'components/modules/CardTabs'
import Gallery, { GQL_GALLERY_MODULE } from 'components/modules/Gallery'
import VideoGallery, { GQL_VIDEO_GALLERY_MODULE } from 'components/modules/VideoGallery'
import IconBlocks, { GQL_ICON_BLOCKS_MODULE } from 'components/modules/IconBlocks'
import IconBar, { GQL_ICON_BAR_MODULE } from 'components/modules/IconBar'
import ContactForm, { GQL_CONTACT_FORM_MODULE } from 'components/modules/ContactForm'
import Html, { GQL_HTML_MODULE } from 'components/modules/Html'

export const ModuleMap = {  
  Text: Text,
  Video: Video,
  LogoCarousel: LogoCarousel,
  Cta: Cta,
  HorizontalAccordionA: HorizontalAccordion,
  HorizontalAccordionB: HorizontalAccordion,
  AccordionA: Accordion,
  AccordionB: Accordion,
  AccordionC: Accordion,
  VideoCarouselA: VideoCarousel,
  VideoCarouselB: VideoCarousel,
  TimelineA: Timeline,
  TimelineB: Timeline,
  TimelineC: Timeline,
  MediaTextA: MediaText,
  MediaTextB: MediaText,
  MediaTextC: MediaText,
  MediaText2xA: MediaText2x,
  MediaText2xB: MediaText2x,
  MediaText2xC: MediaText2x,
  CardsA: Cards,
  CardsB: Cards,
  CardsC: Cards,
  CardCarousel: CardCarousel,
  GalleryA: Gallery,
  GalleryB: Gallery,
  GalleryC: Gallery,
  CardTabs: CardTabs,  
  VideoGalleryA: VideoGallery,
  IconBlocks: IconBlocks,
  Html: Html,  
  IconBar: IconBar,
  ContactForm: ContactForm,    
}

const Modules = ({
  modules=[]
}) => {        
  return (
    <S_Modules id='modules'>
      {modules.map((data, i) => {
        const key = data.__typename?.match(/[^_]+$/)[0]          
        const Module = ModuleMap[key]
        
        if ( Module ) {
          return (
            <Module {...data} key={i} />
          )
        }         
      })}
    </S_Modules>
  )
}

const S_Modules = styled.div``

export const GQL_MODULES = `
  ${GQL_TEXT_MODULE}
  ${GQL_VIDEO_MODULE}
  ${GQL_LOGO_CAROUSEL_MODULE}
  ${GQL_CTA_MODULE}
  ${GQL_HORIZONTAL_ACCORDION_MODULE('A')}
  ${GQL_HORIZONTAL_ACCORDION_MODULE('B')}
  ${GQL_ACCORDION_MODULE('A')}
  ${GQL_ACCORDION_MODULE('B')}
  ${GQL_ACCORDION_MODULE('C')}
  ${GQL_VIDEO_CAROUSEL_MODULE('A')}
  ${GQL_VIDEO_CAROUSEL_MODULE('B')}
  ${GQL_TIMELINE_MODULE('A')}
  ${GQL_TIMELINE_MODULE('B')}
  ${GQL_TIMELINE_MODULE('C')}
  ${GQL_MEDIA_TEXT_MODULE('A')}
  ${GQL_MEDIA_TEXT_MODULE('B')}
  ${GQL_MEDIA_TEXT_MODULE('C')}
  ${GQL_MEDIA_TEXT_2X_MODULE('A')}
  ${GQL_MEDIA_TEXT_2X_MODULE('B')}
  ${GQL_MEDIA_TEXT_2X_MODULE('C')}
  ${GQL_CARDS_MODULE('A')}
  ${GQL_CARDS_MODULE('B')}
  ${GQL_CARDS_MODULE('C')}
  ${GQL_CARD_CAROUSEL_MODULE}
  ${GQL_GALLERY_MODULE('A')}
  ${GQL_GALLERY_MODULE('B')}
  ${GQL_GALLERY_MODULE('C')}
  ${GQL_CARD_TABS_MODULE}
  ${GQL_VIDEO_GALLERY_MODULE('A')}
  ${GQL_ICON_BLOCKS_MODULE}
  ${GQL_HTML_MODULE}
  ${GQL_ICON_BAR_MODULE}
  ${GQL_CONTACT_FORM_MODULE}

  fragment Modules on Page {
    pageContent {
      modules {
        ...TextModule
        ...VideoModule
        ...LogoCarouselModule
        ...CtaModule
        ...HorizontalAccordionAModule
        ...HorizontalAccordionBModule
        ...AccordionAModule
        ...AccordionBModule
        ...AccordionCModule
        ...VideoCarouselAModule
        ...VideoCarouselBModule
        ...TimelineAModule
        ...TimelineBModule
        ...TimelineCModule
        ...MediaTextAModule
        ...MediaTextBModule
        ...MediaTextCModule
        ...MediaText2xAModule
        ...MediaText2xBModule
        ...MediaText2xCModule
        ...CardsAModule
        ...CardsBModule
        ...CardsCModule
        ...CardCarouselModule
        ...GalleryAModule
        ...GalleryBModule
        ...GalleryCModule
        ...CardTabsModule
        ...VideoGalleryAModule
        ...IconBlocksModule
        ...HtmlModule
        ...IconBarModule
        ...ContactFormModule
      }
    }    
  }
`

export default Modules
