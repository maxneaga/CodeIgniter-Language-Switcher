<h1>CodeIgniter Language Switcher</h1>
<p>A tiny language detection / selection library for CodeIgniter.<br />
Allows for setting the user's language preference. Stores the selection in a session.</p>

<h2>Installation</h2>
Drop the <b>libraries</b> folder into your <b>application</b> directory.

<h2>Usage</h2>
<ul>
    <li>Load the library:<br>
        <code>$this->load->library('language');</code></li>
    <li>Load a language file:<br>
        <code>$this->lang->load('filename', $this->language->get());</code></li>
</ul>

<p>
and you are done!
<br><br>
You may switch the user's language by: <code>$this->language->set('en');</code><br><br>

Here is an example controller function on how to get started:<br>
<pre>
    function lang($lang = 'en')
    {
	    $this->language->set($lang);
	    redirect('/', 'refresh');
	}
</pre>
</p>
