# convertRGBAToHSLA
Converts colours from rgba() format to hsla() format.

```js

const convertRGBAToHSLA = (r, g, b, a) => {

  let h = 0;
  let s = 0;
  let l = 0;
  
  r = (r / 255);
  g = (g / 255);
  b = (b / 255);

  let cmin = Math.min(r, g, b);
  let cmax = Math.max(r, g, b);
  let delta = cmax - cmin;

  // Calculate hue
  switch (true) {
  
    case (delta === 0): h = 0; break;
    case (cmax === r): h = ((g - b) / delta) % 6; break;
    case (cmax === g): h = (b - r) / delta + 2; break;
    case (cmax === b): h = (r - g) / delta + 4; break;
  }
   
  h = Math.round(h * 60);
  h = (h < 0) ? h += 360 : h;
  
  // Start lightness calculation
  l = (cmax + cmin) / 2;

  // Start saturation calculation
  s = (delta === 0) ? 0 : delta / (1 - Math.abs(2 * l - 1));
    
  // Complete saturation and lightness calculation
  s = +(s * 100).toFixed(2);
  l = +(l * 100).toFixed(2);  
  
  return `hsl(${h}, ${s}%, ${l}%, ${a})`;
}

console.log(convertRGBAToHSLA(147, 133, 26, 0.66));

```
