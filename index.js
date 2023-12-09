const prev = document.getElementById('prev-btn')
const next = document.getElementById('next-btn')
const list = document.getElementById('item-list')

const itemWidth = 200
const padding = 40

prev.addEventListener('click',()=>{
  list.scrollLeft -= itemWidth + padding
})

next.addEventListener('click',()=>{
  list.scrollLeft += itemWidth + padding
})