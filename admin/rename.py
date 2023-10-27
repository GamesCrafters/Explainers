from os import getcwd, listdir, rename
import re

if __name__ == '__main__':
    regex = re.compile("^t_\w+\.jpg$")
    images = [(f, "resized-" + f[2:]) for f in listdir(getcwd())
              if regex.match(f)]
    for image in images:
        print "Renaming %s to %s" % image
        rename(image[0], image[1])
