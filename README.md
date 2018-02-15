# Instagram Api plugin for Craft CMS 3.x

Instagram Api guzzle endpoint plugin for JS to consume as AJAX

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require admench/instagram-api

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Instagram Api.

## Instagram Api Overview

Simple Instagram Api endpoint for Craft CMS - intended for Javascript to consume as AJAX post request, returning users feed

## Configuring Instagram Api

Make sure you create a `.env` variable with your Instagram Access Token as `INSTAGRAM_ACCESS_TOKEN`

## Using Instagram Api

Here is an example Vue Component which consumes the endpoint `/actions/instagram-api/feed`:

```
<script>
export default {
	props: ["csrfToken"],
	data() {
		return {
			instagramFeed: {
				data: [],
				meta: {
					code: null
				},
				pagination: {}
			}
		};
	},
	created() {
		var qsparams = qs.stringify({
			CRAFT_CSRF_TOKEN: this.csrfToken
		});
		axios
			.post("/actions/instagram-api/feed", qsparams)
			.then(response => {
				this.instagramFeed = response.data;
			})
			.catch(e => {
				this.instagramFeed = e;
				console.log("error: " + e);
				console.log(e);
			});
	},
	computed: {
		feedReady() {
			return true;
			return this.instagramFeed.meta.code == 200;
		}
	}
};
</script>

<template>
    <div>
		<transition name="bounce-left">
			<div v-if="feedReady">
				<img v-for="post in instagramFeed.data" :src="post.images.thumbnail.url" alt="">
			</div>
		</transition>
		<pre>
			{{ instagramFeed }}
		</pre>
	</div>
</template>
```

## Instagram Api Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [Adam Menczykowski](https://youi.design)
