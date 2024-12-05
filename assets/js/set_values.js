const setValues = () => {
  fetch(`/assets/values/${localStorage.getItem('lang') || 'id'}.json`)
  .then(response => response.json())
  .then(values => {
    let elements = document.querySelectorAll('[val]');
    for(let element of elements){
      text = values[element.getAttribute('val')] || '';
      for(let i=0;i<element.attributes.length;i++){
        attr = element.attributes[i];
        if(/^val-.*/.test(attr.nodeName)){
          text = text.replace(
            attr.nodeName.replace(/^val-/, ':'),
            attr.nodeValue
          )
        }
      }
      element.innerHTML = text;
    }
  });
};
