<?php get_header(); ?>
	<div id="page-content">

    <style>

      * {
        line-height: 1.2;
        margin: 0;
      }

      html {
        color: #888;
        display: table;
        font-family: sans-serif;
        height: 100%;
        text-align: center;
        width: 100%;
      }

      body {
        display: table-cell;
        vertical-align: middle;
        margin: 2em auto;
      }

      h1 {
        color: #555;
        font-size: 2em;
        font-weight: 400;
      }

      p {
        margin: 0 auto;
        width: 280px;
      }

      @media only screen and (max-width: 280px) {

        body, p {
          width: 95%;
        }

        h1 {
          font-size: 1.5em;
          margin: 0 0 0.3em;
        }
      }
    </style>

		<h1>Page Not Found</h1>
    <p>Sorry, but the page you were trying to view does not exist.</p>

		<?php get_search_form(); ?>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
