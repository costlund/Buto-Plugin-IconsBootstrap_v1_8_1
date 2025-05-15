# Buto-Plugin-IconsBootstrap_v1_8_1
- Bootstrap svg icons (2000 icons).
- icons.getbootstrap.com
- Updated with icons from v1.13.0.
- All icons in file /data/icons.yml

## Widget include
Get an icon (alarm).
```
type: widget
data:
  plugin: icons/bootstrap_v1_8_1
  method: icon
  data:
    icon: alarm 
```
Add style (optional).
```
    style: "margin-top:-4px"
```

## Widget list
List all icons in a table.
```
type: widget
data:
  plugin: icons/bootstrap_v1_8_1
  method: list
```

## Icon (webmaster)
- http://localhost/?webmaster_plugin=icons/bootstrap_v1_8_1&page=icon&icon=emoji-angry

## List (webmaster)
- http://localhost/?webmaster_plugin=icons/bootstrap_v1_8_1&page=list

## Update process (only developer)
- Get new icons from https://github.com/twbs/icons (folder icons).
- Put icons in folder /new_icons.
- Run page http://localhost/?webmaster_plugin=icons/bootstrap_v1_8_1&page=create_file.
- Delete icons in folder /new_icons.