// Images
const importAllPictures = (r) => r.keys().forEach(r);
importAllPictures(
  require.context("./pictures/", true, /\.(jpe?g|png|gif|svg)$/)
);

// Import scripts
import "./scripts/main";
