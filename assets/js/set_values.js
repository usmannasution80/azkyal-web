const setValues = () => {
  fetch(`/assets/values/${localStorage.getItem('lang') || 'id'}.json`)
  .then(response => response.json())
  .then(values => {
    let elements = document.querySelectorAll('[val]');
    for(let element of elements){
      let keys = element.getAttribute('val');
      let text;
      keys.split('.').forEach(key => {
        if(/^\d+$/.test(key))
          text = text ? text[parseInt(key)] : values[parseInt(key)]
        else
          text = text ? text[key] : values[key];
      });
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
