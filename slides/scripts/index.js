var contacts = [
  {key: 1, id: "1", title: "おしゃれワンライナー", date: "2016/07/01", description: "Unicorn"},
  {key: 2, id: "2", title: "マークダウン", date: "2016/08/01", description: "test1"},
  {key: 3, id: "3", title: "my AWS", date: "2016/08/02", description: "test2"},
]

var ContactItem = React.createClass({
  propTypes: {
    key: React.PropTypes.string,
    id: React.PropTypes.string,
    title: React.PropTypes.string.isRequired,
    email: React.PropTypes.string,
    description: React.PropTypes.string,
  },

  render: function() {
    // I wrap mult-line return statements in parentheses to avoid the
    // inevitable bugs caused by forgetting that JavaScript will throw away
    // the final lines when possible. The parentheses are not strictly
    // necessary.
    return (
      React.createElement('li', {},
        React.createElement('span', {className: 'col'}, this.props.id),
        React.createElement('span', {className: 'col'}, this.props.date),
        React.createElement('span', {className: 'col'}, 
          React.createElement('a', {href: '/slides/'+this.props.id}, this.props.title)
        )
      )
    )
  },
})

var ItemElements = contacts
//  .filter(function(contact) { return contact.email })
  .map(function(contact) { return React.createElement(ContactItem, contact) })

var rootElement =
  React.createElement('div', {}, 
//    React.createElement('h1', {}, "Contacts"),
    React.createElement('ul', {className: 'slist'}, ItemElements)
  )

ReactDOM.render(rootElement, document.getElementById('react-app'))
