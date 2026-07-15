import {
  ApolloClient,
  InMemoryCache, 
  HttpLink, 
  ApolloLink
} from '@apollo/client'
import { createPersistedQueryLink } from '@apollo/client/link/persisted-queries'
import createUploadLink from 'apollo-upload-client/createUploadLink.mjs'

import { sha256 } from 'crypto-hash'

import getConfig from 'next/config'

import { gql } from '@apollo/client'

let client 

async function cms ( query, variables, authenticated ) {  
  const { serverRuntimeConfig, publicRuntimeConfig } = getConfig()
  
  const persistenQueryLink = createPersistedQueryLink({ 
    sha256, 
    useGETForHashedQueries: true
  })
  
  const httpLink = new createUploadLink({
    uri: `${serverRuntimeConfig.apiUrl || publicRuntimeConfig.apiUrl}/graphql`    
  })  

  const authToken = btoa(`${process.env.WP_APPLICATION_USER}:${process.env.WP_APPLICATION_PASSWORD}`)
  const authLink = new ApolloLink((operation, forward) => {        
    operation.setContext(({ headers = {} }) => ({
      headers: {
        ...headers,
        authorization: authenticated ? `Basic ${authToken}` : null,
      }
    }))
  
    return forward(operation)
  })

  if ( client ) {
    client.cache.reset()
  }
              
  client = new ApolloClient({   
    link: persistenQueryLink.concat(authLink).concat(httpLink),
    cache: new InMemoryCache({
      resultCaching: false,
      typePolicies: {
        EmailField: {
          keyFields: false
        },
        PhoneField: {
          keyFields: false
        },
        TextField: {
          keyFields: false
        }, 
        TextAreaField: {
          keyFields: false
        }, 
        RadioField: {
          keyFields: false
        }, 
        CheckboxField: {
          keyFields: false
        }, 
        SelectField: {
          keyFields: false
        }, 
        FileUploadField: {
          keyFields: false
        }, 
        HiddenField: {
          keyFields: false
        }, 
        CaptchaField: {
          keyFields: false
        }
      }
    })
  })  
  
  if ( query.match(/mutation\(/) ) {
    return await client.mutate({
      mutation: gql`${query}`,
      variables,
      errorPolicy: 'all'    
    })
  } else {
    return await client.query({
      query: gql`${query}`,
      variables,
      errorPolicy: 'all'    
    })
  }    
}

export default cms
