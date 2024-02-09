# HTML
## Typographie
Die Typographie umfasst allgemeine Textformatierungen.

- Überschriften 
- Absätze 
- Inline Textelemente 
- Abkürzungen 
- Zitate 
- Listen


## Überschriften
Es gibt insgesamt sechs standardmäßig verschiedene Überschriften.

````html
<h1>&Uuml;berschrift 1</h1>
<h2>&Uuml;berschrift 2</h2>
<h3>&Uuml;berschrift 3</h3>
<h4>&Uuml;berschrift 4</h4>
<h5>&Uuml;berschrift 5</h5>
<h6>&Uuml;berschrift 6</h6>
````
Dir ist bestimmt schon das ``&Uuml;`` aufgefallen. Dies ist ein Code, der dem Browser sagt, dass es sich um einen U-Umlaut handelt. Die ganze Liste findest du (später) hier.


## Absätze
Absätze werden verwendet, um Sinnesabschnitte zu unterteilen.

````html
<p>
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et.
</p>
````

## Inline Textelemente
Bestimmte Tags werden normalerweise nur einzelne Worte verwendet. Etwa, um diese hervorzuheben.

<p>You can use the mark tag to <mark>highlight</mark> text.</p>
<p><del>This line of text is meant to be treated as deleted text.</del></p>
<p><s>This line of text is meant to be treated as no longer accurate.</s></p>
<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
<p><u>This line of text will render as underlined.</u></p>
<p><small>This line of text is meant to be treated as fine print.</small></p>
<p><strong>This line rendered as bold text.</strong></p>
<p><em>This line rendered as italicized text.</em></p>

````html
<p>You can use the mark tag to <mark>highlight</mark> text.</p>
<p><del>This line of text is meant to be treated as deleted text.</del></p>
<p><s>This line of text is meant to be treated as no longer accurate.</s></p>
<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>
<p><u>This line of text will render as underlined.</u></p>
<p><small>This line of text is meant to be treated as fine print.</small></p>
<p><strong>This line rendered as bold text.</strong></p>
<p><em>This line rendered as italicized text.</em></p>
````

## Abkürzungen

<p><abbr title="attribute">attr</abbr></p>
<p><abbr title="HyperText Markup Language">HTML</abbr></p>

````html
<p><abbr title="attribute">attr</abbr></p>
<p><abbr title="HyperText Markup Language">HTML</abbr></p>
````

## Zitate

<figure>
  <blockquote>
    <p>A well-known quote, contained in a blockquote element.</p>
  </blockquote>
  <figcaption>
    Someone famous in <cite title="Source Title">Source Title</cite>
  </figcaption>
</figure>

````html
<figure>
  <blockquote>
    <p>A well-known quote, contained in a blockquote element.</p>
  </blockquote>
  <figcaption>
    Someone famous in <cite title="Source Title">Source Title</cite>
  </figcaption>
</figure>
````


## Listen
### Unsortierte Listen
Die Listeneinträge unsortierter Listen werden im Gegensatz zu sortierten Listen durch Punkte markiert.

<ul>
  <li>This is a list.</li>
  <li>It appears completely unstyled.</li>
  <li>Structurally, it's still a list.</li>
  <li>However, this style only applies to immediate child elements.</li>
  <li>Nested lists:
    <ul>
      <li>are unaffected by this style</li>
      <li>will still show a bullet</li>
      <li>and have appropriate left margin</li>
    </ul>
  </li>
  <li>This may still come in handy in some situations.</li>
</ul>

````html
<ul>
  <li>This is a list.</li>
  <li>It appears completely unstyled.</li>
  <li>Structurally, it's still a list.</li>
  <li>However, this style only applies to immediate child elements.</li>
  <li>Nested lists:
    <ul>
      <li>are unaffected by this style</li>
      <li>will still show a bullet</li>
      <li>and have appropriate left margin</li>
    </ul>
  </li>
  <li>This may still come in handy in some situations.</li>
</ul>
````

### Sortierte Listen
Das folgende Beispiel ist eine sortierte Liste. Listenpunkt 5 selbst stellt jedoch eine unsortierte Liste dar. Wir sehen, jeder Listeneintrag kann auch eine weitere Liste oder sogar ein ganz anderes HTML-Element darstellen.

<ol>
  <li>This is a list.</li>
  <li>It appears completely unstyled.</li>
  <li>Structurally, it's still a list.</li>
  <li>However, this style only applies to immediate child elements.</li>
  <li>Nested lists:
    <ul>
      <li>are unaffected by this style</li>
      <li>will still show a bullet</li>
      <li>and have appropriate left margin</li>
    </ul>
  </li>
  <li>This may still come in handy in some situations.</li>
</ol>

````html
<ol>
  <li>This is a list.</li>
  <li>It appears completely unstyled.</li>
  <li>Structurally, it's still a list.</li>
  <li>However, this style only applies to immediate child elements.</li>
  <li>Nested lists:
    <ul>
      <li>are unaffected by this style</li>
      <li>will still show a bullet</li>
      <li>and have appropriate left margin</li>
    </ul>
  </li>
  <li>This may still come in handy in some situations.</li>
</ol>
````
