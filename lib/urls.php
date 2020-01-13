<?php
/**
 * A bunch of useful functions for playing with URLs.
 *
 * Note: there is no support for backslash '\' directory separators, as used in Windows.
 * (Since Windows supports either, and Unix requires forward slashes '/',
 * as a rule of thumb always use forward slashes as path separators in both URLs and paths.)
 * Use convertSlashes() if necessary.
 *
 * @requires strings.php
 */


/**
 * Replaces backslashes in a string to forward slashes.
 *
 * @param string $path
 * @return string
 */
function convertSlashes($path)
{
	return str_replace($path, '\\', '/');
}


/**
 * Finds the base URL of the host.
 *
 * @return string
 */
function getBaseUrl()
{
	$protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
	echo $protocol;
	$p = strpos($protocol, '/');
	if ($p !== false)
	{
		$protocol = substr($protocol, 0, $p);
	}
	$host = $_SERVER['HTTP_HOST'];
	$url = "$protocol://$host";
	return $url;
}


/**
 * Gets the full URL of the current script, i.e. result should match the browser's address bar.
 *
 * @return string
 */
function getCurrentUrl()
{
	$url = getBaseUrl().$_SERVER['REQUEST_URI'];
	return $url;
}


/**
 * Converts a local URL to a local path.
 * Returns false if not a local file.
 *
 * @param string $url
 * @return string
 */
function url2path($url)
{
	$docRoot = $_SERVER['DOCUMENT_ROOT'];
	$baseUrl = getBaseUrl();
	$url = removeQueryString($url);
	if (beginsWith($url, $baseUrl))
	{
		return str_replace($baseUrl, $docRoot, $url);
	}
	else
	{
		return false;
	}
}


/**
 * Converts a local path to a local URL.
 * Returns false if not a local file.
 *
 * @param string $path
 * @return string
 */
function path2url($path)
{
	$docRoot = $_SERVER['DOCUMENT_ROOT'];
	$baseUrl = getBaseUrl();
	if (beginsWith($path, $docRoot))
	{
		return str_replace($docRoot, $baseUrl, $path);
	}
	else
	{
		return false;
	}
}


/**
 * Removes the last part (from the last '/' forward) from a path or URL.
 * This could be the filename or a subfolder.
 *
 * @param string $path
 * @return string
 */
function removeLastPathPart($path)
{
	$p = strrpos($path, '/');
	return $p === false ? '' : substr($path, 0, $p);
}


/**
 * Removes the first part (up to and including the first '/') from a path or URL.
 *
 * @param string $path
 * @return string
 */
function removeFirstPathPart($path)
{
	$p = strpos($path, '/');
	return $p === false ? '' : substr($path, $p + 1);
}


/**
 * Resolves a relative URL into an absolute URL.
 *
 * @param string $url
 * @return string
 */
function resolveUrl($url) {
	$urlParts = parse_url($url);
	if (!$urlParts['scheme']) {
		// A relative URL:
		$currentUrl = getCurrentUrl();
		// remove the filename and querystring from the current URL:
		$dir = removeLastPathPart($currentUrl);
		while (beginsWith($url, "../")) {
			$url = removeFirstPathPart($url);
			$dir = removeLastPathPart($dir);
		}
		$url = "$dir/$url";
	}
	return $url;
}

/**
 * Removes the querystring from a URL.
 *
 * @param string $url
 * @return string
 */
function removeQueryString($url)
{
	$p = strrpos($url, '?');
	return $p === false ? $url : substr($url, 0, $p);
}


/**
 * Adds a querystring parameter to a URL.
 *
 * @param string $url
 * @param string $key
 * @param string $value
 * @param bool $encodeValue
 * @return string
 */
function addQueryStringParameter($url, $key, $value, $encodeValue = false)
{
	if ($encodeValue)
	{
		$value = urlencode($value);
	}
	return $url.(inStr('?', $url) ? '&' : '?').$key.'='.$value;
}


/**
 * Returns code to include a given JavaScript file in a web page.
 * If this is a local file, appends a querystring parameter 'mtime' with the modified time of the file.
 * This will cause the browser to reload the file if it gets changed.
 *
 * @param string $url
 * @return string
 */
function getIncludeJavaScriptXhtml($url)
{
	$url = resolveUrl($url);
	$path = url2path($url);
	if (file_exists($path))
	{
		$mtime = filemtime($path);
		$url = addQueryStringParameter($url, 'mtime', $mtime);
	}
	$code = "<script src='$url'></script>\n";
	return $code;
}


/**
 * Prints the code to include a given JavaScript file in a web page.
 *
 * @param string $url A relative or absolute URL to the JavaScript file.
 */
function includeJavaScript($url)
{
	$code = getIncludeJavaScriptXhtml($url);
	echo $code;
}


/**
 * Returns code to include a given CSS file in a web page.
 * If this is a local file, appends a querystring parameter 'mtime' with the modified time of the file.
 * This will cause the browser to reload the file if it gets changed.
 *
 * @param string $url
 * @return string
 */
function getIncludeCssXhtml($url)
{
	$url = resolveUrl($url);
	$path = url2path($url);
	if (file_exists($path))
	{
		$mtime = filemtime($path);
		$url = addQueryStringParameter($url, 'mtime', $mtime);
	}
	$code = "<link type='text/css' rel='stylesheet' href='$url' />\n";
	return $code;
}


/**
 * Prints the code to include a given CSS file in a web page.
 *
 * @param string $url A relative or absolute URL to the CSS file.
 */
function includeCss($url)
{
	$code = getIncludeCssXhtml($url);
	echo $code;
}
?>
