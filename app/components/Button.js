import { forwardRef } from 'react'
import styled from 'styled-components'

import { Icon } from 'components/SVGIcons'

export const Text = ({
  children,
  ...props
}) => {
  return (
    <S_Text {...props}>
      {children}
    </S_Text>
  )
}

const S_Text = styled.button`
  ${p => p.theme.mixins.acfTypography('global.buttonMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.buttonDesktop.regular')};
  }
`

export const TextArrow = forwardRef(({
  children,
  link=false,
  ...props
}, ref) => {
  return (
    <S_TextArrow {...props} ref={ref} as={link ? 'a' : 'button'}>
      <span>{children}</span>
      <Icon icon='arrow-right' />
    </S_TextArrow>
  )
})

const S_TextArrow = styled.button`
  display: inline-flex;
  align-items: center;

  ${p => p.theme.mixins.acfTypography('global.buttonMobile.regular')};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.buttonDesktop.regular')};
  }

  span {
    display: inline-block;
    margin: 0 10px 0 0;
    line-height: 1;
    ${p => p.theme.mixins.linkDecoration()};
  }

  .icon {
    width: 16px;
    height: 16px;
    fill: currentColor;
  }
`

export const Cta = forwardRef(({
  children,
  link=false,
  iconColor,
  iconBackground,
  iconBorder,
  iconColorHover,
  iconBackgroundHover,
  iconBorderHover,
  size,
  ...props
}, ref) => {    
  return (
    <S_Cta {...props}
      ref={ref}
      as={link ? 'a' : 'button'}
      $iconColor={iconColor}
      $iconBackground={iconBackground}
      $iconBorder={iconBorder}
      $iconColorHover={iconColorHover}
      $iconBackgroundHover={iconBackgroundHover}
      $iconBorderHover={iconBorderHover}
      $size={size}
    >
      <span>{children}</span>
      <span>
        <i>
          <Icon icon='arrow-right' />
        </i>        
      </span>
    </S_Cta>
  )
})

const S_Cta = styled.button`
  position: relative;
  display: inline-flex;
  align-items: center;
  flex-direction: row;

  ${p => p.theme.mixins.acfTypography('global.buttonMobile.' + (p.$size || 'regular'))};

  ${p => p.theme.media.minWidth('desktop')} {
    ${p => p.theme.mixins.acfTypography('global.buttonDesktop.'+ (p.$size || 'regular'))};
  }

  span:nth-child(1) {
    display: inline-block;
    margin: 0 20px 0 0;
    color: currentColor;
    white-space: nowrap;
  }

  span:nth-child(2) {
    position: relative;
    margin-bottom: 1px;
    border: solid 1px ${p => p.theme.mixins.acfColor(p.$iconBorder) || p.theme.colors.black};
    border-radius: 50%;
    padding: 7px;
    transition: border-color 200ms ease;
    ${p => p.theme.mixins.acfTypography('global.buttonMobile.regular')};

    ${p => p.theme.media.minWidth('desktop')} {
      ${p => p.theme.mixins.acfTypography('global.buttonDesktop.regular')};
    }

    i {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 49px;
      height: 49px;
      border-radius: 50%;
      background-color: ${p => p.theme.mixins.acfColor(p.$iconBackground) || p.theme.colors.black};
      transition: background-color 200ms ease;
    }

    .icon {
      position: relative;
      color: ${p => p.theme.mixins.acfColor(p.$iconColor) || p.theme.colors.white};
      transition: color 200ms ease;
      z-index: 2;
    }
  }

  @media(hover:hover) {
    &:hover {
      span:nth-child(2) {
        border-color: ${p => p.theme.mixins.acfColor(p.$iconBorderHover) || p.theme.colors.gray} !important;
      }
    
      i {
        background-color: ${p => p.theme.mixins.acfColor(p.$iconBackgroundHover) || p.theme.colors.gray} !important;
      }

      .icon {
        color: ${p => p.theme.mixins.acfColor(p.$iconColorHover) || p.theme.colors.white} !important;
      }
    }
  }  
`

export const Play = forwardRef(({
  className,
  ...props
}, ref) => {
  return (
    <S_Play className={className} {...props} ref={ref}>
      <Icon icon='play' />
    </S_Play>
  )
})

const S_Play = styled.button`
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  flex: 0 0 60px;
  border-radius: 50%;

  color: ${p => 
    p.theme.mixins.acfColor('components.video.accentColor') ||
    p.theme.colors.black
  };   

  &:before {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};
    background-color: ${p => p.theme.colors.white};
    border-radius: 50%;
    z-index: 1;
    transition: transform 300ms ease;
  }

  &:after {
    content: '';
    ${p => p.theme.mixins.fill('absolute')};
    border-radius: 50%;
    border: solid 2px ${p => p.theme.colors.white};
    transform: scale(1.2);
    opacity: 0;
    pointer-events: none;

    transition:
      transform 300ms ease,
      opacity 300ms ease
    ;    
  }

  .icon {
    position: relative;
    width: 20px;
    height: 20px;
    margin: 0 0 0 3px;
    z-index: 2;
    transition:
      color 300ms ease,
      transform 300ms ease
    ;
  }

  @media(hover:hover) {
    &:hover .icon {
      transform: scale(1.25);
      color: ${p => p.theme.colors.white};
    }
  
    &:hover:before {
      transform: scale(0);
    }
  
    &:hover:after {
      transform: scale(1);
      opacity: 1;
    }
  }
  
  ${p => p.trigger}:hover & {
    .icon {
      transform: scale(1.25);
      color: ${p => p.theme.colors.white};
    }

    &:before {
      transform: scale(0);
    }
    
    &:after {
      transform: scale(1);
      opacity: 1;
    }
  }
`
