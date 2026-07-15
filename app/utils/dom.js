import ReactHtmlParser from '@hedgedoc/html-to-react';
import compact from 'lodash/compact'
import map from 'lodash/map'
import { v4 as uuidv4 } from 'uuid'
import trim from 'lodash/trim'

export const nl2br = ( string ) => {
  return string.replace(/(?:\r\n|\r|\n)/g, '<br>')
}

export const safeHtmlParser = ( html ) => {  
  const transform = (node, index) => {          
    if (node.type === 'script') {
      if ( node.children?.length ) {
        return (
          <script 
            {...node.attribs} 
            dangerouslySetInnerHTML={{ __html: node.children[0].data }} 
          />
        )
      } else {        
        return (
          <script {...node.attribs} />
        )
      }
      
    }    
  };

  const options = {
    transform,
  };
  
  return compact(map(compact(ReactHtmlParser(trim(html), options)), el => {
    if ( typeof(el) === 'string' ) {
      return 
    }
       
    return {
      ...el,
      key: uuidv4()
    }
  }))
}

export const isUrlActive = ( url, currentUrl ) => {
  let match

  if ( currentUrl ) {
    match = currentUrl
  } else if ( typeof(window) !== 'undefined' ) {
    match = window.location.href
  }
  
  if ( !match || !url ) return false

  const regex = new RegExp(`${url.replace(/\/$/, "")}$`)
  
  return !!match.match(regex)
}

export const wrapAll = ( nodes, wrapper ) => {
  if ( nodes?.length ) {    
    nodes[0].parentNode.insertBefore(wrapper, nodes[0]);
    for (var i in nodes) {
      if ( nodes[i].nodeType ) {
        wrapper.appendChild(nodes[i])
      }      
    }
  }
}

export const scale = (mode, source, target) => {
  if ( mode !== 'cover' && mode !== 'contain' ) {
		throw new Error('Invalid mode')
	}

	const sourceRatio = source.width / source.height
	const targetRatio = target.width / target.height
	let { width } = target
	let { height } = target

	if ( mode === 'contain' ? (sourceRatio > targetRatio) : (sourceRatio < targetRatio) ) {
		height = width / sourceRatio
	} else {
		width = height * sourceRatio
	}

	return {
		width,
		height,
		x: (target.width - width) / 2,
		y: (target.height - height) / 2,
	}
}