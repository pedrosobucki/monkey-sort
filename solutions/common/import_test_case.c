#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, char *argv[])
{
  // FILE* ptr;
  // char ch;

  // char* filename = "../../../test-cases/caso0050.txt";

  // // Opening file in reading mode
  // ptr = fopen(filename, "r");

  // if (NULL == ptr) {
  //     printf("file can't be opened \n");
  // }

  // printf("content of this file are \n");

  // // Printing what is written in file
  // // character by character using loop.
  // do {
  //     ch = fgetc(ptr);
  //     printf("%c", ch);

  //     // Checking if character is not EOF.
  //     // If it is EOF stop reading.
  // } while (ch != EOF);

  // // Closing the file
  // fclose(ptr);
  
  // return 0;

  int bytes_read;
  int size = 10;
  char *string;

  printf ("Please enter a string: ");

  /* These 2 lines are very important. */
  string = (char *) malloc (size);
  bytes_read = getline (&string, &size, stdin);

  if (bytes_read == -1)
  {
    puts ("ERROR!");
  }
  else
  {
    puts ("You entered the following string: ");
    puts (string);
    printf ("\nCurrent size for string block: %d", bytes_read);
  }
  return 0;
}