import styled from 'styled-components'
import { ErrorMessage } from 'formik'

const Error = ({
  name,
  className
}) => {
  return (
    <ErrorMessage
        name={name}
        render={message => (
            <S_Error className={className}>
               {message}
            </S_Error>
          )}
    />
  )
}

const S_Error = styled.div`
  margin: 10px 0 0 0;
  font-size: 1.2rem;
  line-height: 1.3;
  color: red;
`

export default Error
