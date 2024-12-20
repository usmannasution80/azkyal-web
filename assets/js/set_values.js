const setValues = () => {
  let values = VALUES[localStorage.getItem('lang') || 'id'];
  let elements = document.querySelectorAll('[val]');
  for(let element of elements){
    let keys = element.getAttribute('val');
    let text;
    keys.split(/(?<!\\)\./).forEach(key => {
      key = key.replace('\\.', '.', key);
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
};
