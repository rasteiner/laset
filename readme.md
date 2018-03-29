This is a Kirby 3 plugin exercise. Not really useful, not really ready for production.

# "Laset"?!
**Las**t **e**dit **t**imer. It tells you the number of seconds since your last edit on a page.

# Installation
Move this folder to `/site/plugins/laset`

# Usage
In a page blueprint, declare a `type: laset` setion. There are no options.

```yaml
sections:
  last-edit-timer:
    type: laset
```

# Edit and build this project

install poi:

```bash
npm i -g poi
```

being in the plugin folder folder, run:

```bash
poi build
```
