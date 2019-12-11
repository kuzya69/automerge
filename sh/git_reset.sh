cd C:/Users/alarin/Desktop/widgets
git checkout master
git reset --hard
git clean -f -d
git branch -D $1_$2
git push origin --delete $1_$2
read -p "Press enter to continue"