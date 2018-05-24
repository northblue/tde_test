# tde_test
This is a simple project for TDE interview test



How to set up it on local Dev environment:

Upload the source folder into your local php server (such as Mamp or vagrant box).
The entery point of the application is "root_folder/pub/index.php".

Input country name (country name must follow ISO 3166-1 country names standard).
Click search, you will see the returning result.



A bit thoughts for this App:

I found a bug from the geo.getTopArtists API call. Some time the API call returns the wrong number of the search results. For example, if you request 5 results for each page, the second page will return 10 results (it will return the first 5 results and the second 5 results as well). What I did to workaround this issue is getting the last 5 results every time (luckily, the last 5 result are always the correct ones) 

I also found the return result for the total pages is wrong. Therefore, I cannot add a link to the last page (This bit of code was committed out from the app)

All search result can be added to bookmark since the search keyword and paging info was passed from URL(Be aware, the search results may be different for the same url on a different time. Since the data may be updated from last.fm side )




Todo: (Since that is a quick test, there are still something we can improve if we want to use it as a product)

The entry point of the application and css file were placed into the pub folder. That is for the sake of good structure and security. A .htaccess file or server-side ACL should be applied to restrict the direct access to all other folders except the pub folder.

An input validation should be added to the search form. That will prevent the illegal characters from breaking php application or API call. Should never trust the input data from the end user.

Since it is a quite small app, I didn't use any oop methodology. It saved me some time. But it will be good for extensibility and reusability if I can some more time to apply oop methodology to it.
