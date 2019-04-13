/*changing the view based on the navigation*/

//const feeds = $('');
const Agents = $("#agents-div");
const Home = $("#forms");

const homeLi = $("#home-li");
const agentsLi = $("#agents-li");
const feedsLi = $("#feeds-li");

let Swith = (a) => {
  console.log(a);
  console.log(b);
  console.log(c);
};
Agents.hide();
//add event Listeners to the navs
homeLi.on("click", () => {
  Agents.hide();
  Home.show();
});
agentsLi.on("click", () => {
  Home.hide();
  Agents.show();
});
