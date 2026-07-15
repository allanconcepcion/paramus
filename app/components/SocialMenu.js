import { useContext } from 'react'
import styled from 'styled-components'

import { Icon } from 'components/SVGIcons'
import AppContext from 'contexts/App'

const SocialNav = ({
  className
}) => {
  const { socialMenu } = useContext(AppContext)
  
  return (
    <S_SocialNav className={className}>
      <ul>
        {socialMenu?.map((link, i) => (
          <li key={i}>
            <a 
              href={link.url} 
              target='_blank' 
              aria-label={link.socialMenu.icon}
            >
              <Icon icon={link.socialMenu.icon} />
            </a>
          </li>
        ))}        
      </ul>
    </S_SocialNav>
  )
}

const S_SocialNav = styled.nav`
  ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 37px;
    height: 37px;
    border: solid 1px currentColor;
    border-radius: 50%;
    ${p => p.theme.mixins.linkFade(.7)};
  }

  .icon {
    width: 2rem;
    height: 2rem;
    color: currentColor;
  }
`

export const GQL_SOCIAL_MENU = `  
  fragment SocialMenu on MenuItem {    
    url  
    socialMenu {
      icon 
    }
  }
`

export default SocialNav
